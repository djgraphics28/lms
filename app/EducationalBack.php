<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalBack extends Model
{
    protected $fillable = [
        'member_id',
        'education_level',
        'name_of_school',
        'year_graduated',
        'status'
    ];
}
