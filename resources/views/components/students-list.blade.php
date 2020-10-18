<table class="students-list js_students-table table table-hover mt-3">
  <caption class="students-list__caption">
    @if(empty($search))
      Отображено {{ count($students) }} студентов
    @else
      Найдено {{ $students->total() }} студентов
      <a class="btn-link" href="{{ route("list") }}">Сбросить поиск</a>
    @endif
  </caption>

  <thead class="bg-primary text-white">
  <tr>
    @foreach(["name" => "Имя", "surname" => "Фамилия", "group" => "Группа", "points" => "Баллы"] as $col => $col_name)
      <th scope="col">
        <a class="text-white" href="{{ $cols_data[$col]["url"] }}">
          {{ $col_name }}
          {{ $cols_data[$col]["current"] ? ($cols_data[$col]["sort_order"] === "asc" ? "▼" : "▲") : "" }}
        </a>
      </th>
    @endforeach
  </tr>
  </thead>

  <tbody>
  @forelse($students as $student)
    <tr>
      @foreach(["name", "surname", "group", "points"] as $key)
        <td>{{ $student[$key] }}</td>
      @endforeach
    </tr>
  @empty
    <tr style="background-color: inherit">
      <td colspan="4" class="text-center text-muted">
        {{ !empty($search) ? "По вашему запросу не найдено ни одного студента" : "Список пуст" }}</td>
    </tr>
  @endforelse
  </tbody>
</table>

{!! $pagination_html !!}

@if(!empty($search))
  @push("scripts")
    <script>
        (() => {
            let search = `{{ $search }}`,
                searchRegExp = new RegExp(search, "gi");
            document.querySelectorAll(".js_students-table tbody td").forEach(td => {
                let innerText = td.innerHTML,
                    i = innerText.search(searchRegExp);
                if (i >= 0) {
                    td.innerHTML =
                        `${innerText.substr(0, i)}<span style="background: yellow;">` +
                        `${innerText.substr(i, search.length)}</span>` +
                        `${innerText.substr(i + search.length)}`;
                }
            });
        })();
    </script>
  @endpush
@endif
