@extends("layout.main")

@if(!empty($student))
  @section("title", "Редактировать данные")
@else
  @section("title", "Регистрация")
@endif

@section("content")
  {{--  {{ dd($student) }}--}}
  <div class="col-lg-6 mx-auto mt-5">
    <fieldset style="border-radius: 25px; padding: 25px; border: 2px solid #007bff;">

      <x-student-form :student="$student"></x-student-form>

    </fieldset>
  </div>
@endsection
