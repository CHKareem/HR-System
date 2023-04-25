<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hourlyvacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeId',
        'requestDate',
        'vacationDate',
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
