<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = [
        'senior_id',
        'amount',
        'status'
    ];
}
