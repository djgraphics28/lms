<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';

    protected $fillable = [
        'user_id',
        'user_profile_pic',
        'user_birthdate',
        'user_civil_status',
        'user_gender',
        'user_address',
        'user_street',
        'user_brgy',
        'user_mobile_num',
        'user_phone_num'
    ];
}
