<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacationtype extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacationType',
    ];

    public function employeesvacations(){
        return $this->hasMany(EmployeesVacation::class, 'type_id'); 
        
    }

}
