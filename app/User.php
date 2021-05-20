<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'dni','address','phone','role'
    ];

    protected $hidden = [
        'password', 'remember_token', 'pivot',
         'email_verified_at', 'created_at','updated_at'
    ];

    public static $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

    public static function createPatient(array $data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'patient'
        ]);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // $user->specialties
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class)->withTimeStamps();
    }

    public function scopePatients($query)
    {
        return $query -> where('role','patient');
    }

     public function scopeDoctors($query)
    {
        return $query -> where('role','doctor');
    }

    public function attendedAppointments()
    {
        return $this->asDoctorAppointments()->where('status','Atendida');
    }

      public function cancelledAppointments()
    {
        return $this->asDoctorAppointments()->where('status','Cancelada');
    }

    public function asDoctorAppointments()
    {
        return $this->hasMany(Appointment::class,'doctor_id');
    }

     public function asPatientAppointments()
    {
        return $this->hasMany(Appointment::class,'patient_id');
    }


}
