
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
        <form method="post" action="{{ route('login') }}" class="col-lg-3 col-md-4 col-10 mx-auto text-center bg-white p-5 shadow-lg">
        @csrf
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('website.home') }}">
            <img src="{{ asset('images/settings/' . $setting->logo) }}" style="width: 100px;" alt="">
          </a>
          <h1 class="h6 mb-3">{{ __('words.signIn') }}</h1>

          <div class="form-group">
            <label for="inputEmail" class="sr-only">{{ __('words.email') }}</label>
            <input type="email" id="inputEmail" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('words.email') }}"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="inputPassword" class="sr-only">{{ __('words.password') }}</label>
            <input type="password" id="inputPassword" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('words.password') }}" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="checkbox mb-3">
            <label>
              <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('words.remember') }} </label>
          </div>
          <button class="btn btn-lg btn-success btn-block" type="submit">{{ __('words.login') }}</button>

          <div class="row pt-3">

                      
            <div class="col-4">
              <a class="btn btn-link" style="font-size: 15px;" href="{{ route('register') }}">
                  {{ __('words.register') }}
              </a>
          </div>

            <div class="col-8">
              @if (Route::has('password.request'))
                  <a class="btn btn-link text-danger" href="{{ route('password.request') }}">
                      {{ __('words.forgotYourPassword') }}
                  </a>
              @endif
          </div>

          

          </div>


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