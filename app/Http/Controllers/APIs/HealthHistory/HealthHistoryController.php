<?php

namespace App\Http\Controllers\APIs\HealthHistory;

use Exception;
use App\Models\Medication;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use App\Models\MedicalHistory;
use App\Models\AllergyInformation;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\MedicationResource;
use App\Http\Resources\VaccinationResource;
use App\Http\Resources\MedicalHistoryResource;
use App\Http\Resources\AllergyInformationResource;
use App\Http\Requests\HealthHistory\MedicationRequest;
use App\Http\Requests\HealthHistory\VaccinationRequest;
use App\Http\Requests\HealthHistory\MedicalHistoryRequest;
use App\Http\Requests\HealthHistory\AllergyInformationRequest;
use Illuminate\Support\Facades\Validator;

class HealthHistoryController extends Controller
{
    public function saveMedicalHistory(MedicalHistoryRequest $request)
    {
        $validator = $request->validated();
        try {
            $medicalHistory = new MedicalHistory;
            $medicalHistory->user_id         = $validator['user_id']        ?? null;
            $medicalHistory->disease         = $validator['disease']        ?? null;
            $medicalHistory->diagnosis_date  = $validator['diagnosis_date'] ?? null;
            $medicalHistory->description     = $validator['description']    ?? null;
            $medicalHistory->status          = $validator['status']         ?? null;
            $medicalHistory->hospital        = $validator['hospital']       ?? null;

            if ($request->hasFile('report_file')) {
            $medicalHistory->report_file = $request->file('report_file')
                ->store('medical_reports', 'public');
            } else {
                $medicalHistory->report_file = $validator['report_file'] ?? null;
            }
            $medicalHistory->save();
            Log::info("Successfully create the Medical History.", ['create' => 'success']);
            return response()->apiSuccess(new MedicalHistoryResource($medicalHistory), "Successfully create the new Medical Histroy");

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getMedicalHistory(Request $request)
    {
        try {
            $getMedicalHistory = MedicalHistory::all();
            if ($getMedicalHistory->isEmpty()) {
                Log::info('No allergy information found.');
                return response()->apiError('No record found while fetching the allergy information.');
            }
            
            Log::info("Successfully fetched the Medical History Record", ['count' => $getMedicalHistory->count()]);
            return response()->apiSuccess(MedicalHistoryResource::collection($getMedicalHistory), "Successfully fetched the Medical History Record.");

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function deleteMedicalHistory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid'  => 'required|integer',
        ]);
        if ($validator->fails()) {
            Log::warning("Medical History Validator faield", $validator->errors());
            return response()->apiError("Validation failed error", $validator->errors(), 422);
        }
        try {
            $deleMedicalHistory = MedicalHistory::find($request->uuid);
            if (!$deleMedicalHistory) {
                return response()->apiError("Medical History data not found");
            }
            $deleMedicalHistory->delete();

            Log::info("Successfully delete the Medical History Record", ['id' => $request->uuid]);
            return response()->apiSuccess([], "Successfully delete the Medical History Record");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function saveAllergyInformation(AllergyInformationRequest $request)
    {
        $validator = $request->validated();
        try {
            $allergyInformation = new AllergyInformation;
            $allergyInformation->user_id        = $validator['user_id']         ?? null;
            $allergyInformation->type           = $validator['type']            ?? null;
            $allergyInformation->allergy_name   = $validator['allergy_name']    ?? null;
            $allergyInformation->reaction_type  = $validator['reaction_type']   ?? null;
            $allergyInformation->severity       = $validator['severity']        ?? null;
            $allergyInformation->identify_date  = $validator['identify_date']   ?? null;
            $allergyInformation->note           = $validator['note']            ?? null;
            $allergyInformation->status         = $validator['status'] ?? 'active';
            $allergyInformation->save();

            Log::info("Successfully create the Allergy Information", ['create' => 'success']);
            return response()->apiSuccess(new AllergyInformationResource($allergyInformation), "Successfully create the Allergy Information.");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getAllergyInformation(Request $request)
    {
        try {
            $getAllergyInformation = AllergyInformation::all();
            if ($getAllergyInformation->isEmpty()) {
                Log::info('No allergy information found.');
                return response()->apiError('No record found while fetching the allergy information.');
            }

            Log::info("Successfully fetched the Allergy Information", ['count' => $getAllergyInformation->count()]);
            return response()->apiSuccess(AllergyInformationResource::collection($getAllergyInformation), "Successfully fetched the Allergy Information.");

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function deleteAllergyInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid'  => 'required|integer',
        ]);
        if ($validator->fails()) {
            Log::warning("Allergy Information Validator faield", $validator->errors());
            return response()->apiError("Validation failed error", $validator->errors(), 422);
        }
        try {
            $deleteAllergyInformation = AllergyInformation::find($request->uuid);
            if (!$deleteAllergyInformation) {
                return response()->apiError("Medical History data not found");
            }
            $deleteAllergyInformation->delete();

            Log::info("Successfully delete the Allergy Information Record", ['id' => $request->uuid]);
            return response()->apiSuccess([], "Successfully delete the Allergy Information Record");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }
    
    public function saveMedication(MedicationRequest $request)
    {
        $validator = $request->validated();
        try {
            $medication = new Medication;
            $medication->user_id    = $validator['user_id'] ?? null;
            $medication->medication_name    = $validator['medication_name'] ?? null;
            $medication->dosage             = $validator['dosage'] ?? null;
            $medication->frequency          = $validator['frequency'] ?? null;
            $medication->start_date         = $validator['start_date'] ?? null;
            $medication->end_date           = $validator['end_date'] ?? null;
            $medication->duration           = $validator['duration'] ?? null;
            $medication->reason             = $validator['reason'] ?? null;
            $medication->is_taking          = $validator['is_taking'] ?? null;
            $medication->status             = $validator['status'] ?? 'active';

            $medication->save();
            Log::info("Successfully create the Medication Record", ['create' => 'success']);
            return response()->apiSuccess(new MedicationResource($medication), "Successfully create the Medication Record");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        } 
    }

    public function getMedication(Request $request)
    {
        try {
            $getMedication = Medication::all();
            if ($getMedication->isEmpty()) {
                Log::info('No Medication data found.');
                return response()->apiError('No record found while fetching the allergy information.');
            }

            Log::info("Successfully fetched the Medication Record", ['count' => $getMedication->count()]);
            return response()->apiSuccess(MedicationResource::collection($getMedication), "Successfully fetched the Medication Record.");

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function deleteMedication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid'  => 'required|integer',
        ]);
        if ($validator->fails()) {
            Log::warning("Medication Validator faield", $validator->errors());
            return response()->apiError("Validation failed error", $validator->errors(), 422);
        }
        try {
            $deleteMedication = Medication::find($request->uuid);
            if (!$deleteMedication) {
                return response()->apiError("Medication data record not found");
            }
            $deleteMedication->delete();

            Log::info("Successfully delete the Medication Record", ['id' => $request->uuid]);
            return response()->apiSuccess([], "Successfully delete the Medication Record");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function saveVaccination(VaccinationRequest $request)
    {
        $validator = $request->validated();

        try {
            $vaccination = new Vaccination;
            $vaccination->user_id           = $validator['user_id']             ?? null;
            $vaccination->vaccine_name      = $validator['vaccine_name']        ?? null;
            $vaccination->type              = $validator['type']                ?? null;
            $vaccination->administered_date = $validator['administered_date']   ?? null;
            $vaccination->next_due_date     = $validator['next_due_date']       ?? null;
            $vaccination->hospital          = $validator['hospital']            ?? null;
            $vaccination->note              = $validator['note']                ?? null;
            $vaccination->status            = $validator['status']              ?? 'active';
            if ($request->hasFile('proof_file')) {
                $vaccination->proof_file = $request->file('proof_file')
                    ->store('vaccination_reports', 'public');
            }
            $vaccination->save();

            Log::info("Successfully created the Vaccination Record", ['create' => 'success']);
            return response()->apiSuccess(new VaccinationResource($vaccination), "Successfully created the Vaccination Record");

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getVaccination(Request $request)
    {
        try {
            $getVaccination = Vaccination::all();
            if ($getVaccination->isEmpty()) {
                Log::info('No Vaccination data found.');
                return response()->apiError('No record found while fetching the Vaccination record.');
            }

            Log::info("Successfully fetched the Vaccination Record", ['count' => $getVaccination->count()]);
            return response()->apiSuccess(VaccinationResource::collection($getVaccination), "Successfully fetched the Vaccination Record.");

        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function deleteVaccination(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid'  => 'required|integer',
        ]);
        if ($validator->fails()) {
            Log::warning("Vaccination Validator faield", $validator->errors());
            return response()->apiError("Validation failed error", $validator->errors(), 422);
        }
        try {
            $deleteVaccination = Vaccination::find($request->uuid);
            if (!$deleteVaccination) {
                return response()->apiError("Vaccination data record not found");
            }
            $deleteVaccination->delete();

            Log::info("Successfully delete the Vaccination Record", ['id' => $request->uuid]);
            return response()->apiSuccess([], "Successfully delete the Vaccination Record");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }
}
