<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title')</title>
    @include('dashbaord.layout.styles')
  </head>
  <body class="vertical  light rtl ">
    <div class="wrapper">
@include('dashbaord.layout.header')
@include('dashbaord.layout.sidbar')

<main role="main" class="main-content">
          @yield('content')
       
      </main> <!-- main -->
    </div> <!-- .wrapper -->
@include('dashbaord.layout.scripts')
  </body>
</html>