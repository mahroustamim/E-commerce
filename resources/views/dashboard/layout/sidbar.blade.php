<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
          <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
            <g>
              <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
              <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
              <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
            </g>
          </svg>
        </a>
      </div>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item w-100">
          <a class="nav-link" href="{{ route('dashboard.home') }}">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.dashboard') }}</span>
          </a>
        </li>
      </ul>
      <p class="text-muted nav-heading mt-4 mb-1">
        <span>{{ __('words.main') }}</span>
      </p>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item dropdown">
          <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.orders') }}</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('dashboard.orders.pending') }}"><span class="ml-1 item-text">{{ __('words.pending') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('dashboard.orders.delivering') }}"><span class="ml-1 item-text">{{ __('words.delivering') }}</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('dashboard.orders.completed') }}"><span class="ml-1 item-text">{{ __('words.completed') }}</span></a>
            </li>
            
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-inbox fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.products') }}</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="forms">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('dashboard.products.index') }}"><span class="ml-1 item-text">{{ __('words.products') }}</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('dashboard.products.create') }}"><span class="ml-1 item-text">{{ __('words.add') }} {{ __('words.product') }}</span></a>
            </li>
          </ul>
        </li>
        @can('is_admin')          
          <li class="nav-item dropdown">
            <a href="#supervisors" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-user-check fe-16"></i>
              <span class="ml-3 item-text">{{ __('words.supervisors') }}</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="supervisors">
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('dashboard.supervisors') }}"><span class="ml-1 item-text">{{ __('words.supervisors') }}</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('dashboard.supervisors.create') }}"><span class="ml-1 item-text">{{ __('words.add') }} {{ __('words.supervisor') }}</span></a>
              </li>
            </ul>
          </li>
        @endcan
        <li class="nav-item w-100">
          <a class="nav-link" href="{{ route('dashboard.users') }}">
            <i class="fe fe-users fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.users') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link" href="{{ route('dashboard.reports') }}">
            <i class="fe fe-trello fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.reports') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link" href="{{ route('dashboard.categories.index') }}">
            <i class="fe fe-grid fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.categories') }}</span>
          </a>
        </li>
        @can('is_admin')
          <li class="nav-item w-100">
            <a class="nav-link" href="{{ route('dashboard.setting') }}">
              <i class="fe fe-settings fe-16"></i>
              <span class="ml-3 item-text">{{ __('words.settings') }}</span>
            </a>
          </li>
        @endcan

      
      </ul>
      <p class="text-muted nav-heading mt-4 mb-1">
        <span>{{ __('words.pages') }}</span>
      </p>
      <ul class="navbar-nav flex-fill w-100 mb-2">

        <li class="nav-item w-100">
          <a class="nav-link" href="{{ route('website.profile',  auth()->user()->id) }}">
            <i class="fe fe-user fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.profile') }}</span>
          </a>
        </li>

        <li class="nav-item w-100">
          <a class="nav-link" href="{{ route('website.home') }}" target="_blank">
            <i class="fe fe-shopping-bag fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.website') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link" href="http://localhost/projects/E-commerce/public/logs">
            <i class="fe fe-alert-triangle fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.logs') }}</span>
          </a>
        </li>
        

      </ul>
      <p class="text-muted nav-heading mt-4 mb-1">
        <span>{{ __('words.extra') }}</span>
      </p>
      <ul class="navbar-nav flex-fill w-100 mb-2">

        
        <li class="nav-item dropdown">
          <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-file fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.language') }}</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100 w-100" id="pages">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ url('dashboard/set-locale/en') }}">
                <span class="ml-1 item-text">English</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ url('dashboard/set-locale/ar') }}">
                <span class="ml-1 item-text">عربي</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item w-100">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fe fe-log-out fe-16"></i>
            <span class="ml-3 item-text">{{ __('words.logout') }}</span>
          </a>
        </li>


    </nav>
  </aside>