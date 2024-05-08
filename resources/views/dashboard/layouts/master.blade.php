<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title')</title>

    @include('dashboard.layouts.styles')

  </head>
  <body class="vertical  light rtl ">

    <div class="wrapper">

        @include('dashboard.layouts.header')

      @include('dashboard.layouts.sidebar')

     @yield('content')
    </div> <!-- .wrapper -->
    @include('dashboard.layouts.scripts')
  </body>
</html>