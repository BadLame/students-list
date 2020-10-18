<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property string $group
 * @property int $points
 * @property string $token
 * @method static Builder|Student newModelQuery()
 * @method static Builder|Student newQuery()
 * @method static Builder|Student query()
 * @method static Builder|Student whereGender($value)
 * @method static Builder|Student whereGroup($value)
 * @method static Builder|Student whereId($value)
 * @method static Builder|Student whereName($value)
 * @method static Builder|Student wherePoints($value)
 * @method static Builder|Student whereSurname($value)
 * @method static Builder|Student whereToken($value)
 * @mixin Eloquent
 */
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

    protected $fillable = [
        "name",
        "surname",
        "group",
        "gender",
        "points",
        "token"
    ];


    public function saveInSession()
    {
        session([
            "student" => $this->toArray(),
            "authenticated" => true
        ]);
    }
}
