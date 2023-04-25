<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class EmployeeVacation extends Pivot
{
    use HasFactory;

    public $incrementing = true;


    protected $fillable = [
        'employee_id',
        'vacation_id',
        'requestDate',
        'vacationDate',
        'typeId',
        'duration',
        'reason',
    ];

}
