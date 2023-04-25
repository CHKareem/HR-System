<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'position_id',
        'startDate',
        'endDate',
        'department_id',
        'center_id',
    ];
	
	    protected $hidden = [
        'id',
        'created_at',
        'updated_at', 
    ];


    public function employees(){
        return $this->belongsTo(Employee::class, 'employee_id'); 
        
    }

    public function positions(){
        return $this->belongsTo(Position::class, 'position_id'); 
        
    }

    public function centers(){
        return $this->belongsTo(Center::class, 'center_id'); 
        
    }

    public function departments(){
        return $this->belongsTo(Department::class, 'department_id'); 
        
    }

}
