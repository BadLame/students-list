<div class="head-menu my-3">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a href="{{ route("list") }}"
                class="nav-link {{ request()->routeIs("list") ? "active" : "" }}">Список</a>
        </li>
        <li class="nav-item">
            <a href="{{ route("student") }}"
               class="nav-link {{ request()->routeIs("student") ? "active" : "" }}">
                @if($authenticated)
                    Редактировать данные
                @else
                    Регистрация
                @endif
            </a>
        </li>
    </ul>
</div>
