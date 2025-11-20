<?php

use App\Http\Controllers\APIs\Appointment\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\Auth\AuthController;
use App\Http\Controllers\APIs\HealthHistory\HealthHistoryController;
use App\Http\Controllers\APIs\HealthHistory\HealthProfileController;
use App\Http\Controllers\APIs\Subscription\SubscriptionPlanController;
use App\Http\Controllers\APIs\VaccinationTracking\VaccinationTrackingController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function() {
    Route::post('/register',        [AuthController::class, 'register']);
    Route::post('/login',           [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/verify-otp',      [AuthController::class, 'verifyOtp']);
    Route::post('/resend-otp',      [AuthController::class, 'resendOtp']);
    Route::post('/address',         [AuthController::class, 'saveAddress']);
    Route::post('/medical-details', [AuthController::class, 'saveMedicalDetails']);
    Route::post('/emergency-contact',[AuthController::class, 'saveEmergencyContact']);
});

Route::group(['prefix' => 'subscription'], function() {
    Route::get('/', [SubscriptionPlanController::class, 'subscriptionPlanGet']);
});

Route::group(['prefix' => 'health/profile'], function() {
    Route::post('/blood/sugar', [HealthProfileController::class, 'saveBloodSugar']);
    Route::get('/get/blood/sugar', [HealthProfileController::class, 'getBloodSugar']);
    Route::post('/delete/blood/sugar', [HealthProfileController::class, 'deleteBloodSugar']);
    Route::post('/blood/pressure', [HealthProfileController::class, 'saveBloodPressure']);
    Route::get('/get/blood/pressure', [HealthProfileController::class, 'getBloodPressure']);
    Route::post('/delete/blood/pressure', [HealthProfileController::class, 'deleteBloodPressure']);
    Route::post('/heart/rate', [HealthProfileController::class, 'saveHeartRate']);
    Route::get('/get/heart/rate', [HealthProfileController::class, 'getHeartRate']);
    Route::post('/delete/heart/rate', [HealthProfileController::class, 'deleteHeartRate']);
    Route::post('/weight', [HealthProfileController::class, 'saveWeight']);
    Route::get('/get/weight', [HealthProfileController::class, 'getWeight']);
    Route::post('/delete/weight', [HealthProfileController::class, 'deleteWeight']);
});

Route::group(['prefix' => 'health/history'], function() {
    Route::post('/medical/history/store', [HealthHistoryController::class, 'saveMedicalHistory']);
    Route::get('/medical/history/get', [HealthHistoryController::class, 'getMedicalHistory']);
    Route::post('/medical/history/delete', [HealthHistoryController::class, 'deleteMedicalHistory']);
    Route::post('/allergy/information/store', [HealthHistoryController::class, 'saveAllergyInformation']);
    Route::get('/allergy/information/get', [HealthHistoryController::class, 'getAllergyInformation']);
    Route::post('/allergy/information/delete', [HealthHistoryController::class, 'deleteAllergyInformation']);
    Route::post('/medication/store', [HealthHistoryController::class, 'saveMedication']);
    Route::get('/medication/get', [HealthHistoryController::class, 'getMedication']);
    Route::post('/medication/delete', [HealthHistoryController::class, 'deleteMedication']);
    Route::post('/vaccination/store', [HealthHistoryController::class, 'saveVaccination']);
    Route::get('/vaccination/get', [HealthHistoryController::class, 'getVaccination']);
    Route::post('/vaccination/delete', [HealthHistoryController::class, 'deleteVaccination']);
});

Route::group(['prefix' => 'vaccination'], function() {
    Route::post('/tracking/store', [VaccinationTrackingController::class, 'saveVaccinationTracking']);
    Route::post('/booster/store', [VaccinationTrackingController::class, 'saveVaccinationBooster']);
    Route::get('/vaccination/data/get', [VaccinationTrackingController::class, 'getVaccinationData']);
});

Route::group(['prefix' => 'appointment'], function() {
    Route::post('/store', [AppointmentController::class, 'saveAppointment']);
    Route::get('/get', [AppointmentController::class, 'getAppointmentsByStatus']);
    Route::get('/hospital/names', [AppointmentController::class, 'getHospitals']);
    Route::get('/department/names', [AppointmentController::class, 'getDepartments']);
    Route::get('/doctor/names', [AppointmentController::class, 'getDoctors']);
});