<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'positionName',
        'numberOfVacancies',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function PositionEmployees(){
        return $this->hasMany(EmployeesPosition::class, 'position_id'); 
        
    }

}
