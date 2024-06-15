<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $page_desc }}">

    @php
      $data = app('App\Http\Controllers\Web\WebPageController')->web();
    @endphp

    {!! $data->site_script !!}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet"> 
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <div id="app">
     @include('web.nav')
      <main>
          @yield('content')
      </main>

      <!-- Footer -->
      <footer class="page-footer font-small">
        @php
          $data = app('App\Http\Controllers\Web\WebPageController')->web();
          $footer_menu = app('App\Http\Controllers\Web\WebPageController')->footerMenu();
        @endphp

        <div class="footer-top py-5 text-white bg-subscribe">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-md-4 col-lg-4">
                <h3 class="text-white font-weight-bold text-center mb-1">Subscribe Now</h3>
                <div class="mb-2 text-center">Get daily updates of latest certificates published in Ontario</div>
                @include('web.template.subscribe-form')
              </div>
            </div>
          </div>
        </div>
        <div class="footer-top py-2 text-white bg-dark">
          <div class="container">
              <h5 class="text-center mt-3"><a href="{{route('home')}}">{{$data->site_title}}</a></h5>
              <ul class="list-unstyled mb-3 d-flex justify-content-center">
                @foreach($footer_menu as $menu)
                  <li class="nav-item {{ $loop->last ? '' : 'mr-3' }} {{ (Request::url() == $menu['link']) ? 'active' : ''}}">
                      <a class="nav-link" href="{{ url($menu['link']) }}">{{ $menu['label'] }} </a>
                  </li>
                @endforeach
              </ul>
          </div>
        </div>
        <!-- Copyright -->
        <div class="font-white text-center py-2 bg-dark footer-bottom">
          {!! $data->copyright_text !!}
        </div>
        <!-- Copyright -->

      </footer>
      <!-- Footer -->
    </div>
</body>
</html>
