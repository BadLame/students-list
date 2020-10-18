<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield("title", "Не забывай про заголовок")</title>
  <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  <link rel="stylesheet" href="{{ asset("css/layouts/main.css") }}">

  @stack("styles")
</head>
<body>

<div class="container">
  <header class="layout__header">
    <div class="layout__menu-container">
      <x-head-menu :authenticated="session('authenticated')"></x-head-menu>
    </div>
  </header>

  <div class="layout__content-container">
    @section("content")@show
  </div>

</div>

@stack("scripts")
</body>
</html>
