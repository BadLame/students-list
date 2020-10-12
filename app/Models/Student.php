<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public const GENDER_MALE = "male";
    public const GENDER_FEMALE = "female";

    public const PER_PAGE = 10;

    public $timestamps = false;

    public $hidden = [
        "token"
    ];
}
