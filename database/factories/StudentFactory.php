<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = mt_rand(1,2) == 1 ? Student::GENDER_MALE : Student::GENDER_FEMALE;
        $ruLetters = ["А","Б","В","Г","Д","Е","Ж","З","И","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ы","Э","Я",];

        return [
            "name" => $this->faker->firstName($gender),
            "surname" => $this->faker->lastName . ($gender == 'female' ? "а" : ""),
            "gender" => $gender,
            "group" => $this->faker->regexify("[0-9]{1,3}") .
                implode("", $this->faker->randomElements($ruLetters, mt_rand(0,2))),
            "points" => mt_rand(100, 400),
            "token" => Str::random(50)
        ];
    }
}
