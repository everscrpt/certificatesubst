@php
  $header_menu = app('App\Http\Controllers\Web\WebPageController')->headerMenu();
  $data = app('App\Http\Controllers\Web\WebPageController')->web();
@endphp

<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
    <a class="navbar-brand" href="/">{{$data->site_title}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            @foreach($header_menu as $menu)
                @if(!$menu['child'])
                <li class="nav-item {{ $loop->last ? '' : 'mr-3' }} {{ (Request::url() == $menu['link']) ? 'active' : ''}}">
                    <a class="nav-link" href="{{ url($menu['link']) }}">{{ $menu['label'] }} </a>
                </li>
                @else
                <li class="nav-item {{ $loop->last ? '' : 'mr-3' }} d-flex align-items-center {{ (Request::url() == $menu['link']) ? 'active' : ''}}">
                    <div class="dropdown show w-xs-100">
                        <a class="dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $menu['label'] }}
                        </a>
                        <div class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                            @foreach($menu['child'] as $child)
                                <a class="dropdown-item" href="{{url($child['link'])}}">{{ $child['label'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
                @endif
            @endforeach
        </ul>
    </div>
    </div>
</nav>