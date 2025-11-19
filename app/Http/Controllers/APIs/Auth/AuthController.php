<?php

namespace App\Http\Controllers\APIs\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PatientDetail;
use App\Models\EmergencyContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\AddressRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\PatientDetailResource;
use App\Http\Resources\AuthenticationResource;
use App\Http\Requests\Auth\MedicalDetailRequest;
use App\Http\Resources\EmergencyContactResource;
use App\Http\Requests\Auth\EmergencyContactRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\OtpVerificationRequest;
use App\Http\Requests\Auth\ResendOtpRequest;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $user = DB::transaction(function () use ($data) {
                $user = User::create([
                    'first_name'      => $data['first_name'],
                    'last_name'       => $data['last_name'],
                    'name'            => trim($data['first_name'] . ' ' . $data['last_name']),
                    'email'           => $data['email'],
                    'phone'           => $data['phone'],
                    'dob'             => $data['dob'],
                    'gender'          => $data['gender'],
                    'material_status' => $data['material_status'],
                    'password'        => Hash::make($data['password']),
                    'status'          => 'pending',
                ]);

                $token = $user->createToken('auth-token')->accessToken;
                $user->token = $token;

                return $user;
            });

            Log::info('User registered successfully', ['email' => $user->email]);

            return response()->apiSuccess(new AuthenticationResource($user), 'User registered successfully.', 201);
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            Log::info('Login failed: invalid credentials', ['email' => $credentials['email']]);

            return response()->apiError(
                'Unable to login, please check your credentials.',
                ['error' => 'Unauthorised'],
                401
            );
        }

        try {
            /** @var User $user */
            $user = User::where('email', $credentials['email'])->firstOrFail();

            if ($user->status === 'blocked') {
                Log::info('Login blocked: account blocked', ['email' => $user->email]);

                return response()->apiError('This account is currently blocked. Please contact support.',['error' => 'Account blocked'],403);
            }

            if ($user->status === 'pending') {
                Log::info('Login denied: account pending', ['email' => $user->email]);

                return response()->apiError('Your account is not active yet.',['error' => 'Account pending'],403);
            }

            $token = $user->createToken('auth-token')->accessToken;
            $user->token = $token; 

            Log::info('User logged in successfully', ['email' => $user->email]);

            return response()->apiSuccess(
                new AuthenticationResource($user),
                'User login successfully.'
            );
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $user = User::where('email', $data['email'])->firstOrFail();

            $otp = (string) random_int(10000, 99999);

            $user->update([
                'OTP'           => $otp,
                'otp_expire_at' => Carbon::now()->addMinutes(10),
                'otp_status'    => 'unverified',
            ]);

            $email   = $user->email;
            $payload = [
                'name'     => $user->name ?? ($user->first_name.' '.$user->last_name),
                'otp'      => $otp,
                'app_name' => config('app.name'),
            ];

            $subject = "Your ".env('APP_NAME')." OTP Code";

            Mail::send('emailTemplate.sendOTP', $payload, function ($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });

            Log::info('Forgot password OTP sent', ['email' => $user->email]);

            return response()->apiSuccess(null, 'OTP has been sent to your email address.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function verifyOtp(OtpVerificationRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {

            $user = User::where('email', $data['email'])->firstOrFail();

            if (!$user->OTP || $user->OTP !== $data['otp']) {
                return response()->apiError('Invalid OTP.',['error' => 'Invalid OTP'],422);
            }

            if (!$user->otp_expire_at || Carbon::parse($user->otp_expire_at)->isPast()) {
                return response()->apiError('OTP has expired.',['error' => 'OTP expired'],422);
            }

            $user->update([
                'otp_status'    => 'verified',
                'OTP'           => null,              
                'otp_expire_at' => null,
            ]);

            Log::info('OTP verified successfully', ['email' => $user->email]);

            return response()->apiSuccess(null, 'OTP verified successfully.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function resendOtp(ResendOtpRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            
            $user = User::where('email', $data['email'])->firstOrFail();

            $otp = (string) random_int(10000, 99999);

            $user->update([
                'OTP'           => $otp,
                'otp_expire_at' => Carbon::now()->addMinutes(10),
                'otp_status'    => 'unverified',
            ]);

            $email   = $user->email;
            $payload = [
                'name'     => $user->name ?? ($user->first_name.' '.$user->last_name),
                'otp'      => $otp,
                'app_name' => config('app.name'),
            ];

            $subject = "Your new ".env('APP_NAME')." OTP Code";

            Mail::send('emailTemplate.sendOTP', $payload, function ($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });

            Log::info('OTP resent', ['email' => $user->email]);

            return response()->apiSuccess(null, 'A new OTP has been sent to your email address.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function saveAddress(AddressRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {

            $user = User::findOrFail($data['user_id']);

            $user->update([
                'address' => $data['address'],
                'city'    => $data['city'],
                'state'   => $data['state'],
                'country' => $data['country'] ?? null,
                'zipcode' => $data['zipcode'],
            ]);

            Log::info('User address updated in signup flow', ['user_id' => $user->id]);
            return response()->apiSuccess(new AuthenticationResource($user->fresh()),'Address details saved successfully.');

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function saveMedicalDetails(MedicalDetailRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $detail = PatientDetail::updateOrCreate(
                ['patient_id' => $data['patient_id']],
                [
                    'height'    => $data['height'],
                    'weight'    => $data['weight'],
                    'blood_type'=> $data['blood_type'],
                    'pregnancy' => $data['pregnancy'],
                    'trimester' => $data['trimester'] ?? null,
                ]
            );

            Log::info('Patient medical details saved', ['patient_id' => $data['patient_id']]);

            return response()->apiSuccess(new PatientDetailResource($detail),'Medical details saved successfully.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function saveEmergencyContact(EmergencyContactRequest  $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $contact = EmergencyContact::updateOrCreate(
                ['user_id' => $data['user_id']],
                [
                    'first_name'     => $data['first_name'] ?? null,
                    'last_name'      => $data['last_name'] ?? null,
                    'relation'       => $data['relation'] ?? null,
                    'contact_number' => $data['contact_number'] ?? null,
                ]
            );

            Log::info('Emergency contact saved', ['user_id' => $data['user_id']]);

            return response()->apiSuccess(new EmergencyContactResource($contact),'Emergency contact saved successfully.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }
}
