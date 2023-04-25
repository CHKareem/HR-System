<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesVacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'vacation_id',
        'vacationDate',
        'type_id',
        'duration',
        'discount',
        'reason',
        'isCheck',
        'isAuthor',
    ];

    public function vacationtypes(){
        return $this->belongsTo(Vacationtype::class, 'type_id'); 
        
    }

    public function vacations(){
        return $this->belongsTo(Vacation::class, 'vacation_id'); 
        
    }

    public function employees(){
        return $this->belongsTo(Employee::class, 'employee_id'); 
        
    }


}
