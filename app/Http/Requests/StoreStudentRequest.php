<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"      => "required|alpha|min:2|max:50",
            "surname"   => "required|alpha|min:2|max:50",
            "gender"    => ["required", Rule::in([Student::GENDER_MALE, Student::GENDER_FEMALE])],
            "group"     => "required|max:5",
            "points"    => "required|numeric|min:50|max:400",
        ];
    }


    public function messages()
    {
        return [
            "name.required"     => "Поле \"Имя\" обязательно для заполнения",
            "name.alpha"        => "В имени не допускаются цифры и знаки препинания",
            "name.min"          => "Минимальная длина поля \"Имя\" - :min символа",
            "name.max"          => "Максимальная длина поля \"Имя\" - :max символов",

            "surname.required"  => "Поле \"Фамилия\" обязательно для заполнения",
            "surname.alpha"     => "В фамилии не допускаются цифры и знаки препинания",
            "surname.min"       => "Минимальная длина поля \"Фамилия\" - :min символа",
            "surname.max"       => "Максимальная длина поля \"Фамилия\" - :max символов",

            "gender.required"   => "Поле \"Пол\" обязательно для выбора",
            "gender.in"         => "Поле пол должно иметь одно из следующих значений: \"Мужской\", \"Женский\"",

            "group.required"    => "Поле \"Группа\" обязательно для заполнения",
            "group.max"         => "Максимальная длина поля \"Группа\" - :max символов",

            "points.required"   => "Поле \"Баллы\" обязательно для заполнения",
            "points.min"        => "Наименьшее количество баллов: :min",
            "points.max"        => "Наибольшее количество баллов: :max"
        ];
    }
}
