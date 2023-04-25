<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Center;


class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'holidayName', 'holidayDate', 'note',
    ];

            public function centers(){
                return $this->belongsToMany(Center::class); 
                
            }


}
