<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailyvacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeId',
        'requestDate',
        'from',
        'to',
        'duration',
        'isAuthorization',
        'type',
        'reason',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
