<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    protected $fillable = [
        'centerName',
    ];


    public function weekends(){
        return $this->belongsToMany(Weekend::class); 
        
    }

    public function holidays(){
        return $this->belongsToMany(Holiday::class); 
        
    }

    // public function employees(){
    //     return $this->hasMany(Employee::class, 'center_id'); 
        
    // }

        public function employees(){
        return $this->hasMany(EmployeesPosition::class, 'center_id'); 
        
    }

}
