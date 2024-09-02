<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title')</title>
    @include('dashboard.layout.styles')
  </head>
  <body class="vertical  light rtl ">
    <div class="wrapper">
@include('dashboard.layout.header')
@include('dashboard.layout.sidbar')

<main role="main" class="main-content">
  <div class="container-fluid">
          @yield('content')
       </div>
      </main> <!-- main -->
    </div> <!-- .wrapper -->
@include('dashboard.layout.scripts')
  </body>
</html>