<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacationName',
    ];

    public function employeesvacations(){
        return $this->hasMany(EmployeesVacation::class, 'vacation_id'); 
        
    }

    
}
