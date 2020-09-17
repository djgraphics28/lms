<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Characterref extends Model
{
    protected $fillable = [
        'member_id',
        'name',
        'contact_number',
        'status'
    ];
}
