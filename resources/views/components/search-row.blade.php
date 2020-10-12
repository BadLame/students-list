<nav class="search-row navbar bg-primary">
    <a class="navbar-brand text-white">
      {{ !empty($search) ? "Поиск студентов" : "Список студентов" }}
    </a>
  <form class="search-row__form form-inline" method="get" rel="search">
    <input class="search-row__input form-control mx-0 my-2" type="search"
           placeholder="Поиск" aria-label="Search"
           name="search"
           value="{{ $search ?? "" }}">
    <button class="search-row__btn btn btn-outline-light m-0 m-sm-2" type="submit">Найти</button>
  </form>
</nav>
