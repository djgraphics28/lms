<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'gender',
        'birthdate',
        'civil_status',
        'place_of_birth',
        'home_address',
        'occupation',
        'tin_no',
        'valid_no',
        'area_of_tillage',
        'location',
        'other_source_income',
        'tenurial_status',
        'initial_capital',
        'profile_pic',
        'phone_num',
        'status',
    ];
}
