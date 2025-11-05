<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Chat\ChatController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Doctor\DoctorController;
use App\Http\Controllers\Admin\Patient\PatientController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Hospital\HospitalController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Appointment\AppointmentController;
use App\Http\Controllers\Admin\Department\DepartmentController;
use App\Models\Department;

Route::get('/', function () {
    return redirect(route('login'));
});
// only Admins can manage users
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users',       [UserController::class, 'store'])->name('users.store');
        Route::get('/users/view', [UserController::class, 'view'])->name('users.view');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin','as' => 'admin.'], function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointment',[AppointmentController::class, 'index'])->name('appointment');
    Route::get('/appointment/view-detail',[AppointmentController::class, 'viewDetail'])->name('appointment.viewDetail');

    // chat routes 
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');


    //Hospital Routes
    Route::get('/hospital', [HospitalController::class, 'index'])->name('hospital');
    Route::get('/hospital/add-hospital', [HospitalController::class, 'create'])->name('hospital.addHospital');
    Route::post('/hospitals', [HospitalController::class, 'store'])->name('hospitals.store');
    Route::get('/hospital/edit/{id}', [HospitalController::class, 'edit'])->name('hospital.hospitalEdit');
    Route::post('/hospital/update/{id}', [HospitalController::class, 'update'])->name('hospital.hospitalUpdate');
    Route::get('/hospital/detail', [HospitalController::class, 'view'])->name('hospital.hospitalDetail');
    Route::delete('/hospital/delete/{id}', [HospitalController::class, 'destroy'])->name('hospital.destroy');
    Route::get('/hospital/invoice/billing/detail', [HospitalController::class, 'invoiceDetail'])->name('hospital.invoiceDetail');

    // Department Routes
    Route::post('department/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('department/store', [DepartmentController::class, 'store'])->name('department.store');

    // Doctor Routes
    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');
    Route::get('/doctor/add-doctor', [DoctorController::class, 'create'])->name('doctor.addDoctor');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/doctor/view-doctor', [DoctorController::class, 'viewDoctor'])->name('doctor.viewDoctor');

    // Patient Routes
    Route::get('/patient', [PatientController::class, 'index'])->name('patient');
    Route::get('/patient/view-patient', [PatientController::class, 'viewPatient'])->name('patient.viewPatient');

    // Setting Routes
    Route::get('/setting',       [SettingController::class, 'index'])->name('setting');          
    Route::post('/setting',       [SettingController::class, 'update'])->name('setting.update');  
    Route::post('/setting/avatar',[SettingController::class, 'updateAvatar'])->name('setting.avatar');
    Route::post('/setting/password', [SettingController::class, 'changePassword'])->name('setting.password');

});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/custom-logout', function () {
    Auth::logout();                                
    request()->session()->invalidate();            
    request()->session()->regenerateToken();       

    return redirect('/');                     
})->name('custom.logout');

require __DIR__.'/auth.php';
