<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pension extends Model
{
    protected $fillable = [
        'senior_id',
        'pension_amount',
        'status'
    ];
}
