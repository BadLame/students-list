@extends("layout.main")

@if(!empty($search))
  @section("title", "Поиск студентов")
@else
  @section("title", "Список студентов")
@endif

@section("content")

  <x-search-row :search="$search"></x-search-row>

  <x-messages-block></x-messages-block>

  <x-students-list :students="$students"
                   :search="$search"
                   :pagination="$pagination"
  ></x-students-list>

  {{--
    session:
    <pre style="white-space: pre-wrap;">@php var_export($session) @endphp</pre>
    <br>
    <hr>
    cookie:
    <pre style="white-space: pre-wrap;">@php var_export($cookie) @endphp</pre>
    <br>
    <hr>  --}}
{{--  request:--}}
{{--    <pre style="white-space: pre-wrap;">@php var_export($request) @endphp</pre>--}}
@endsection
