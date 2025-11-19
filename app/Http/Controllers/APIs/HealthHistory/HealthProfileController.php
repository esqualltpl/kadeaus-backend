<?php

namespace App\Http\Controllers\APIs\HealthHistory;

use Exception;
use App\Models\Weight;
use App\Models\HeartRate;
use App\Models\BloodSugar;
use Illuminate\Http\Request;
use App\Models\BloodPressure;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\WeightResource;
use App\Http\Resources\HeartRateResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BloodSugarResource;
use App\Http\Resources\BloodPressureResource;
use App\Http\Requests\HealthHistory\WeightRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;
use App\Http\Requests\HealthHistory\HeartRateStoreRequest;
use App\Http\Requests\HealthHistory\BloodSugarStoreRequest;
use App\Http\Requests\HealthHistory\BloodPressureStoreRequest;

class HealthProfileController extends Controller
{
    public function saveBloodSugar(BloodSugarStoreRequest $request)
    {
        $data = $request->validated();
        try {
            $bloodSugar = BloodSugar::create([
                'user_id'      => $data['user_id'],
                'value'        => $data['value'],
                'type'         => $data['type'],
                'date'         => $data['date'],
                'time'         => $data['time'],
                'sugar_status' => $data['sugar_status'],
                'status'       => 'active',
            ]);

            Log::info('Blood sugar reading stored', ['user_id' => $data['user_id'], 'id' => $bloodSugar->id]);
            return response()->apiSuccess(new BloodSugarResource($bloodSugar), 'Blood sugar reading added successfully.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getBloodSugar(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:blood_sugar,id'
            ]);
        if ($validator->fails()) {
            return response()->apiError($validator->errors()->first());
        }
        try {
            $user_id = $request->user_id;
            $latest = BloodSugar::where('user_id', $user_id)
                        ->orderBy('date', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->first();

            $history = BloodSugar::where('user_id', $user_id)
                        ->orderBy('date', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->get();

            return response()->apiSuccess([
                'latest'  => $latest ? new BloodSugarResource($latest) : null,
                'history' => BloodSugarResource::collection($history)
            ], 'Blood sugar data fetched successfully.');

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }


    public function deleteBloodSugar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid'  => 'required|integer'
        ]);
        if ($validator->fails()) {
            Log::warning("Blood Sugar validator error", $validator->errors());
            return response()->apiError("Validator failed", $validator->errors(), 422);
        }

        try {
            $deleteBloodSugar = BloodSugar::find($request->uuid);
            if (!$deleteBloodSugar) {
                return response()->apiError("Blood Sugar record not found");
            }

            $deleteBloodSugar->delete();
            Log::info("Blood Sugar record deleted.", ['id' => $request->uuid]);
            return response()->apiSuccess([], "Blood Sugar record deleted successfully.");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function saveBloodPressure(BloodPressureStoreRequest $request)
    {
        $data = $request->validated();
        try {
            $bloodPressure = BloodPressure::create([
                'user_id'   => $data['user_id'],
                'systolic'  => $data['systolic'],
                'diastolic' => $data['diastolic'],
                'date'      => $data['date'],
                'time'      => $data['time'],
                'blood_pressure_status' => $data['blood_pressure_status'],
                'status'    => 'active',
            ]);

            Log::info('Blood Pressure reading stored', ['user_id' => $data['user_id'], 'id' => $bloodPressure->id]);
            return response()->apiSuccess(new BloodPressureResource($bloodPressure), 'Blood pressure reading added successfully.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getBloodPressure(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:blood_pressures,id'
        ]);

        if ($validator->fails()) {
            return response()->apiError($validator->errors()->first());
        }
        try {
            $user_id = $request->user_id;
            $latest = BloodPressure::where('user_id', $user_id)
                        ->orderBy('date', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->first();

            $history = BloodPressure::where('user_id', $user_id)
                        ->orderBy('date', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->get();

            return response()->apiSuccess([
                'latest'  => $latest ? new BloodPressureResource($latest) : null,
                'history' => BloodPressureResource::collection($history)
            ], 'Blood Pressure data fetched successfully.');

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function deleteBloodPressure(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'uuid'  => 'required|integer',
       ]);
       if ($validator->fails()) {
            Log::warning("Delete Blood Pressure Validator error", $validator->errors());
            return response()->apiError("Validator error", $validator->errors(), 422);
       }
       try {
        $deleteBloodPressure = BloodPressure::find($request->uuid);
        if (!$deleteBloodPressure) {
            return response()->apiError("Blood Pressure Record not found");
        }

        $deleteBloodPressure->delete();
        Log::info("Successfully delete Blood Pressure record", ['id' => $request->uuid]);
        return response()->apiSuccess([], "Successfully delete Blood Pressure Record.");
       } catch (Exception $e) {
            return response()->apiCatchError($e);
       }
    }

    public function saveHeartRate(HeartRateStoreRequest $request)
    {
        $data = $request->validated();
        try {
            $heartRate = HeartRate::create([
                'user_id'   => $data['user_id'],
                'bpm'  => $data['bpm'],
                'date'      => $data['date'],
                'time'      => $data['time'],
                'heart_rate_status' => $data['heart_rate_status'],
                'status'    => 'active',
            ]);

            Log::info('Heart reading stored', ['user_id' => $data['user_id'], 'id' => $heartRate->id]);
            return response()->apiSuccess(new HeartRateResource($heartRate), 'Heart rate reading added successfully.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getHeartRate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:heart_rates,user_id'
        ]);

        if ($validator->fails()) {
            return response()->apiError($validator->errors()->first());
        }
        try {
            $user_id = $request->user_id;
            $latest = HeartRate::where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->orderBy('date', 'desc')
                ->first();
            $history = HeartRate::where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->orderBy('date', 'desc')
                ->get();
            
            return response()->apiSuccess([
                'latest'  => $latest ? new HeartRateResource($latest) : null,
                'history' => HeartRateResource::collection($history)
            ], 'Heart Rate data fetched successfully.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    Public function deleteHeartRate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid'  => 'required|integer'
        ]);
        if ($validator->fails()) {
            Log::error("Heart Rate validator error", $validator->errors());
            return response()->apiError("Validator failed", $validator->errors(), 422);
        }
        try {
            $deleteHeartRate = HeartRate::find($request->uuid);
            if (!$deleteHeartRate) {
                return response()->apiError("Heart Rate record not found.");
            }
            $deleteHeartRate->delete();
            Log::info("Heart Rate record deleted successfully.", ['id' => $request->uuid]);
            return response()->apiSuccess([], "Heart Rate Record deleted successfully.");

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function saveWeight(WeightRequest $request)
    {
        $data = $request->validated();
        try {
            $weight = Weight::create([
                'user_id'   => $data['user_id'],
                'weight'    => $data['weight'],
                'date'      => $data['date'],
                'time'      => $data['time'],
                'status'    => 'active',
            ]);

            Log::info('Weight reading stored', ['user_id' => $data['user_id'], 'id' => $weight->id]);
            return response()->apiSuccess(new WeightResource($weight), 'Weight added successfully');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getWeight(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'   => 'required|integer|exists:weights,user_id'
        ]);
        if ($validator->fails()) {
            Log::warning("Weight Validator error while fetching the data", $validator->errors());
            return response()->apiError("Validator failed", $validator->errors(), 422);
        }
        try {
            $user_id = $request->user_id;
            $latest = Weight::where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->orderBy('date', 'desc')
                ->first();
            $history = Weight::where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->orderBy('date', 'desc')
                ->get();
            
            return response()->apiSuccess([
                'latest' => $latest ? new WeightResource($latest) : null,
                'history'=> WeightResource::collection($history),
            ], 'Weight Record fetched successfully.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function deleteWeight(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid'  => 'required|integer'
        ]);
        if ($validator->fails()) {
            Log::warning("Weight validator error", $validator->errors());
            return response()->apiError("Validator error", $validator->errors(), 422);
        }
        try {
            $deleteWeight = Weight::find($request->uuid);
            if (!$validator) {
                return response()->apiError("Weight record not found");
            }
            $deleteWeight->delete();
            Log::info("Weight record deleted", ['id' => $request->uuid]);
            return response()->apiSuccess([],"Weight record deleted successfully.");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }
}
