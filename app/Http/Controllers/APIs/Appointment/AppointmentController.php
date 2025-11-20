<?php

namespace App\Http\Controllers\APIs\Appointment;

use Exception;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Department;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Http\Requests\Appointment\AppointmentRequest;

class AppointmentController extends Controller
{
    public function saveAppointment(AppointmentRequest $request)
    {
        $validator = $request->validated();

        try {
            $appointment = new Appointment();
            $appointment->user_id            = $validator['user_id']            ?? null;
            $appointment->date               = $validator['date']               ?? null;
            $appointment->time               = $validator['time']               ?? null;
            $appointment->description        = $validator['description']        ?? null;
            $appointment->created_by         = $validator['created_by']         ?? null;
            $appointment->rescheduled_by     = $validator['rescheduled_by']     ?? null;
            $appointment->rescheduled_date   = $validator['rescheduled_date']   ?? null;
            $appointment->cancelled_by       = $validator['cancelled_by']       ?? null;
            $appointment->cancelled_date     = $validator['cancelled_date']     ?? null;
            $appointment->hospital_id        = $validator['hospital_id']        ?? null;
            $appointment->department_id      = $validator['department_id']      ?? null;
            $appointment->doctor_id          = $validator['doctor_id']          ?? null;
            $appointment->is_share_documents = $validator['is_share_documents'] ?? null;  // Yes / No
            $appointment->visit_type         = $validator['visit_type']         ?? null;  // In-Person / Video Call
            $appointment->virtual_link       = $validator['virtual_link']       ?? null;
            $appointment->note               = $validator['note']               ?? null;
            $appointment->cancel_reason      = $validator['cancel_reason']      ?? null;
            $appointment->status             = $validator['status']             ?? 'pending';
            $appointment->save();

            Log::info("Successfully created the Appointment", ['appointment_id' => $appointment->id]);
            return response()->apiSuccess(new AppointmentResource($appointment),"Successfully created the Appointment.");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getHospitals(Request $request)
    {
        try {
            $hospitals = Hospital::with(['user:id,name'])
                ->select('id', 'user_id')
                ->get()
                ->map(function ($hospital) {
                    return [
                        'id'   => $hospital->id,
                        'name' => optional($hospital->user)->name, // hospital name from users table
                    ];
                });

            if ($hospitals->isEmpty()) {
                Log::info('No hospitals found.');
                return response()->apiError('No record found while fetching the hospitals.');
            }

            Log::info('Successfully fetched hospitals.', ['count' => $hospitals->count()]);

            return response()->apiSuccess($hospitals, 'Successfully fetched the hospitals.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getDepartments(Request $request)
    {
        try {
            $departments = Department::select('id', 'name')->get();

            if ($departments->isEmpty()) {
                Log::info('No departments found.');
                return response()->apiError('No record found while fetching the departments.');
            }

            Log::info('Successfully fetched departments.', ['count' => $departments->count()]);

            return response()->apiSuccess($departments, 'Successfully fetched the departments.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getDoctors(Request $request)
    {
        try {
            $doctors = Doctor::with(['user:id,name'])
                ->select('id', 'user_id', 'hospital_id', 'department_id')
                ->get()
                ->map(function ($doctor) {
                    return [
                        'id'            => $doctor->id,
                        'name'          => optional($doctor->user)->name, // doctor name from users table
                        'hospital_id'   => $doctor->hospital_id,
                        'department_id' => $doctor->department_id,
                    ];
                });

            if ($doctors->isEmpty()) {
                Log::info('No doctors found.');
                return response()->apiError('No record found while fetching the doctors.');
            }

            Log::info('Successfully fetched doctors.', ['count' => $doctors->count()]);

            return response()->apiSuccess($doctors, 'Successfully fetched the doctors.');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getAppointmentsByStatus(Request $request)
{
    try {
        $status = $request->input('status'); // upcoming, active, completed, cancelled

        // Map "upcoming" → "active" if your DB stores different status values
        $statusMap = [
            'upcoming'  => 'active',
            'completed' => 'completed',
            'cancelled' => 'cancelled',
        ];

        $statusValue = $statusMap[$status] ?? null;

        if (!$statusValue) {
            return response()->apiError('Invalid status filter.');
        }

        $appointments = Appointment::with([
                'doctor.user:id,name',      // doctor → user (name + image)
                'department:id,name',             // department
                'hospital.user:id,name'     // hospital → user (name + image)
            ])
            ->where('status', $statusValue)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        if ($appointments->isEmpty()) {
            Log::info("No appointments found.", ['status' => $statusValue]);
            return response()->apiError('No record found while fetching the appointments.');
        }

        Log::info("Successfully fetched appointments.", [
            'status' => $statusValue,
            'count' => $appointments->count()
        ]);

        return response()->apiSuccess(
            AppointmentResource::collection($appointments),
            "Successfully fetched the appointments."
        );

    } catch (Exception $e) {
        return response()->apiCatchError($e);
    }
}


}
