{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if (app()->getLocale() === 'en')
    <meta content="{{ $setting->content_en }}" name="description">
    @else
    <meta content="{{ $setting->content_ar }}" name="description">
    @endif


    <!-- Favicon -->
    <link href="{{ asset('images/settings/' . $setting->favicon) }}" rel="icon">

    <title>{{ $setting->name_en }}</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('adminAsset/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('adminAsset/css/feather.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('adminAsset/css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('adminAsset/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('adminAsset/css/app-dark.css') }}" id="darkTheme" disabled>
  </head>
  <body class="light rtl">
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">

        <form method="POST" action="{{ route('password.email') }}" class="col-lg-3 col-md-4 col-10 mx-auto text-center bg-white p-5 shadow-lg">
            @csrf
            
          <div class="mx-auto text-center my-4">

            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('website.home') }}">
                <img src="{{ asset('images/settings/' . $setting->logo) }}" style="width: 100px;" alt="">
              </a>

            <h2 class="my-3">{{ __('words.resetPassword') }}</h2>
              <!-- Session Status -->
              @if (session('status'))
              <div class="alert alert-success" role="alert" style="margin-top: 20px;">
                  {{ session('status') }}
              </div>
              @endif
              
          </div>
          <div class="form-group">
            <label for="email" class="sr-only">{{ __('words.email') }}</label>
            <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('words.email') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <button class="btn btn-lg btn-success btn-block mb-5" type="submit">{{ __('words.sendPasswordRessetLink') }}</button>
        </form>
      </div>
    </div>
    <script src="{{ asset('adminAsset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('adminAsset/js/popper.min.js') }}"></script>
    <script src="{{ asset('adminAsset/js/moment.min.js') }}"></script>
    <script src="{{ asset('adminAsset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminAsset/js/simplebar.min.js') }}"></script>
    <script src='{{ asset('AdminAsset/js/daterangepicker.js') }}'></script>
    <script src='{{ asset('AdminAsset/js/jquery.stickOnScroll.js') }}'></script>
    <script src="{{ asset('AdminAsset/js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('AdminAsset/js/config.js') }}"></script>
    <script src="{{ asset('AdminAsset/js/apps.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>
</body>
</html>