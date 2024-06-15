<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('admin') }}" class="simple-text logo-normal">
      {{ __('Certificate') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'page' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('page.index') }}">
          <i class="material-icons">web</i>
            <p>{{ __('Pages') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'menu' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('menu') }}">
          <i class="material-icons">menu</i>
            <p>{{ __('Menu') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'media' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('media') }}">
          <i class="material-icons">perm_media</i>
            <p>{{ __('Media') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'home-page-setting' || $activePage == 'search-page-setting' || $activePage == 'web-setting' || $activePage == 'mailwizz-settings') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="true">
          <i class="material-icons">settings</i>
          <p>{{ __('Settings') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'home-page-setting' || $activePage == 'search-page-setting' || $activePage == 'web-setting' || $activePage == 'mailwizz-settings') ? 'show' : '' }}" id="settings">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'web-setting' ? ' active' : '' }}">
              <a class="nav-link d-flex align-items-center" href="{{ route('web-setting') }}">
                <i class="material-icons">language</i>
                  {{ __('Site Settings') }}
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'home-page-setting' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('home-page-setting') }}">
                <i class="material-icons">home</i>
                  {{ __('Home Page') }}
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'search-page-setting' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('search-page-setting') }}">
                <i class="material-icons">search</i>
                  {{ __('Search Page') }}
              </a>
            </li>

            <li class="nav-item{{ $activePage == 'mailwizz-settings' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('mailwizz-settings') }}">
                <i class="material-icons">email</i>
                  {{ __('Maillwizz Settings') }}
              </a>
            </li>
          </ul>
        </div>
      </li> 
      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
          <i class="material-icons">person</i>
          <span class="sidebar-normal">{{ __('Profile') }} </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="material-icons">exit_to_app</i>
          <span class="sidebar-normal">{{ __('Logout') }} </span>
        </a>
      </li>
    </ul>
  </div>
</div>