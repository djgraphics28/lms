<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'gender',
        'birthdate',
        'civil_status',
        'unique_id_num',
        'address',
        'barangay',
        'street',
        'profile_pic',
        'phone_num',
        'tel_num',
        'status',
    ];
}
