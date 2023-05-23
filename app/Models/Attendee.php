<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Attendee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'logDate',
        'logTime',
        'logIn',
        'logOut',
        'duration',
    ];

    public function employees(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
}
