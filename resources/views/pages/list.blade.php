@extends("layout.main")

@if(!empty($search))
  @section("title", "Поиск студентов")
@else
  @section("title", "Список студентов")
@endif

@section("content")
  <x-search-row :search="$search"></x-search-row>

  <x-students-list :students="$students"
                   :search="$search"
                   :pagination_html="$pagination_html"
                   :cols_data="$cols_data"
  ></x-students-list>
@endsection
