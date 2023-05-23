<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fullName',
        'firstName',
        'lastName',
        'fatherName',
        'motherName',
        'birthAndPlace',
        'nationalNumber',
        'gender',
        'degree',
        'mobile',
        'address',
        'startDate',
        // 'department_id',
        // 'center_id',
        'notes',
        'quitDate',
        'vacationCount',
        'hourlyLate',
        'hourlyVac',
        'noPaymentCount',
        'healthCount',
        'workingYears',
        'isActive',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function attendences(){
        return $this->hasMany(Attendee::class, 'employee_id');
    }

    public function employeesvacations(){
        return $this->hasMany(EmployeesVacation::class, 'employee_id'); 
        
    }

    public function employeePositions(){
        return $this->hasMany(EmployeesPosition::class, 'employee_id'); 
        
    }

    // public function employeeCenter(){
    //     return $this->belongsTo(Center::class, 'center_id'); 
        
    // }

    // public function employeedepartment(){
    //     return $this->belongsTo(Department::class, 'department_id'); 
        
    // }

    public function getGenderNameAttribute($value)
    {
        switch ($this->attributes['gender']) {
            case 1: // here is number not string.
                return 'Male';
            case 0:
                return 'Female';
        }
    }

    public function getIsActiveNameAttribute($value)
    {
        switch ($this->attributes['isActive']) {
            case 1: // here is number not string.
                return 'Active';
            case 0:
                return 'Not Active';
        }
    }
}
