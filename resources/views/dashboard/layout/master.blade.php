<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('images/settings/' . $setting->favicon) }}">
    <title>Dashboard | {{ $setting->name_en }}</title>
    @include('dashboard.layout.styles')
  </head>
  <body class="vertical  light {{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">
    <div class="wrapper">
          @include('dashboard.layout.header')
          @include('dashboard.layout.sidbar')

          <main role="main" class="main-content">
              <div class="container-fluid">
                <div class="row justify-content-center">
                  <div class="col-12">
                    @yield('content')

                  </div>
              </div>
          </main> <!-- main -->
    </div> <!-- .wrapper -->
@include('dashboard.layout.scripts')
  </body>
</html>