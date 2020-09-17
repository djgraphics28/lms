<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $fillable = [
        'record_id',
        'cp_fname',
        'cp_lname',
        'cp_mname',
        'cp_address',
        'relationship',
        'cp_phone_num',
        'cp_tel_num',
    ];

    protected $table = 'contact_person';
}
