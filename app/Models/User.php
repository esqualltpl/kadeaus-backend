<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['first_name', 'last_name', 'name','email', 'phone','otp_expire_at','OTP', 'dob', 'gender', 'password', 'address', 'country', 'city', 'state', 'zipcode', 'added_by'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    public function hospital()
    {
        return $this->hasOne(Hospital::class);
    }

    public function nurse()
    {
        return $this->hasOne(Nurse::class);
    }

    public function parmacist()
    {
        return $this->hasOne(Pharmacist::class);
    }

    public function prescriptionReport()
    {
        return $this->hasOne(PrescriptionReport::class);
    }

    public function qualification()
    {
        return $this->hasOne(Qualification::class);
    }

    public function receptionis()
    {
        return $this->hasOne(Receptionist::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function doctors()
    {
        return $this->hasOne(Doctor::class);
    }
    public function medicalHistories()
{
    return $this->hasMany(MedicalHistory::class, 'user_id');
}
public function allergies()
{
    return $this->hasMany(AllergyInformation::class, 'user_id');
}
public function medications()
{
    return $this->hasMany(Medication::class, 'user_id');
}
public function vaccinations()
{
    return $this->hasMany(Vaccination::class, 'user_id');
}
public function vaccinationBoosters()
{
    return $this->hasMany(VaccinationBooster::class, 'user_id');
}
public function appointments()
{
    return $this->hasMany(Appointment::class, 'user_id');
}

public function createdAppointments()
{
    return $this->hasMany(Appointment::class, 'created_by');
}

public function rescheduledAppointments()
{
    return $this->hasMany(Appointment::class, 'rescheduled_by');
}

public function cancelledAppointments()
{
    return $this->hasMany(Appointment::class, 'cancelled_by');
}

}
