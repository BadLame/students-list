@extends("layout.main")

@if(!empty($student))
  @section("title", "Редактировать данные")
@else
  @section("title", "Регистрация")
@endif

@section("content")

@endsection
