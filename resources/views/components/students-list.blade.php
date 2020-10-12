<table class="students-list js_students-table table table-hover mt-3">
  <caption class="students-list__caption">
    @if(empty($search))
      Отображено {{ count($students) }} студентов
    @else
      Найдено {{ $students->total() }} студентов
    @endif
  </caption>
  <thead class="bg-primary text-white">
  <tr>
    <th scope="col">
      <a href="#">
        Имя
{{--         {{ current ? (asc ? "▼" : "▲") : "" }}--}}
      </a>
    </th>
    <th scope="col">Фамилия</th>
    <th scope="col">Номер группы</th>
    <th scope="col">Баллов</th>
  </tr>
  </thead>
  <tbody>
  @foreach($students as $student)
    <tr>
      @foreach(["name", "surname", "group", "points"] as $key)
        <td>{{ $student[$key] }}</td>
      @endforeach
    </tr>
  @endforeach
  </tbody>
</table>

{!! $pagination !!}

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
