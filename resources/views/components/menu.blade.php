@extends("layout.main")

@push("styles")
  <link rel="stylesheet" href="{{ asset("css/components/menu.css") }}">
@endpush

@section("menu")
  <div class="menu">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a href="{{ route("register") }}"
           class="nav-link {{ Route::current() === "register" ? "active" : "" }}"
        >Регистрация</a>
      </li><li class="nav-item">
        <a href="{{ route("list") }}"
           class="nav-link {{ Route::current() === "list" ? "active" : "" }}">Список</a>
      </li>
    </ul>
  </div>
@endsection
