{{--{{ dd($student) }}--}}
<form method="post" action="{{ !empty($student) ? route("student")."/edit/" : "" }}">
  @csrf

  <div class="form-group">
    <label for="name">Имя</label>
    <input class="form-control {{ $errors->has("name") ? "is-invalid" : "" }}"
           type="text"
           name="name"
           autocomplete="off"
           required
           value="{{ request()->old("name") ?? @$student["name"] ?? "" }}">
    {{--             maxlength="50" required>--}}
    @if($errors->has("name"))
      <div class="invalid-feedback">{{ $errors->first("name") }}</div>
    @endif
  </div>

  <div class="form-group">
    <label for="surname">Фамилия</label>
    <input class="form-control {{ $errors->has("surname") ? "is-invalid" : "" }}"
           type="text"
           name="surname"
           autocomplete="off"
           required
           value="{{ request()->old("surname") ?? @$student["surname"] ?? ""  }}">
    {{--             maxlength="50" required>--}}
    @if($errors->has("surname"))
      <div class="invalid-feedback">{{ $errors->first("surname") }}</div>
    @endif
  </div>

  <span class="input-group-prepend">Пол</span>
  <div class="form-group">
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="gender" value="male"
             id="radio_gender_male" checked>
      <label for="radio_gender_male" class="form-check-label">Мужской</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="gender" value="female"
             id="radio_gender_female"
        {{ (request()->old("gender") === "female" || @$student["gender"] === "female") ?
            "checked" :  "" }}>
      <label for="radio_gender_female" class="form-check-label">Женский</label>
    </div>
    @if($errors->has("gender"))
      <div class="invalid-feedback d-block">{{ $errors->first("gender") }}</div>
    @endif
  </div>

  <div class="form-group">
    <label for="group">Группа</label>
    <input class="form-control {{ $errors->has("group") ? "is-invalid" : "" }}"
           type="text"
           name="group"
           autocomplete="off"
           required
           value="{{ request()->old("group") ?? @$student["group"] ?? "" }}">
    {{--             maxlength="5" required>--}}
    @if($errors->has("group"))
      <div class="invalid-feedback">{{ $errors->first("group") }}</div>
    @endif
  </div>

  <div class="form-group">
    <label for="points">Баллы</label>
    <input class="form-control {{ $errors->has("points") ? "is-invalid" : "" }}"
           type="number"
           name="points"
           autocomplete="off"
           required
           value="{{ request()->old("points") ?? @$student["points"] ?? "" }}">
    {{--             step="1" min="0" max="400" required>--}}
    @if($errors->has("points"))
      <div class="invalid-feedback">{{ $errors->first("points") }}</div>
    @endif
  </div>

  <div class="form-group d-flex flex-row-reverse mt-4">
    <button class="btn btn-primary col-sm-auto col-xs-12" type="submit">Подтвердить</button>
  </div>

</form>
