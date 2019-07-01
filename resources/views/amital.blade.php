@extends("skeleton.main")
@section ("header")
@parent
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@endsection

@section("content")
<section>
  <div class="container py-5">
    <div class="row">
      <div class="col-12" >
        <h1 class="text-center">XParser v.2.0 - Shop Parser</h1>
        <p class="text-center">
          Спецом для Андрея. Вводишь список ISBN, жмешь "Получить анализ цен", ждешь
        </p>
      </div>
    </div>
  </div>
</section>

<div id="app">
  <app></app>
</div>


@endsection

@section("bottom")
@parent
<script src="https://unpkg.com/vue"></script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection
