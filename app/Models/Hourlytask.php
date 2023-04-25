<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hourlytask extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeId',
        'requestDate',
        'taskDate',
        'from',
        'to',
        'duration',
        'type',
        'reason',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
