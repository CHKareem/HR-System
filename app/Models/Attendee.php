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

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
}
