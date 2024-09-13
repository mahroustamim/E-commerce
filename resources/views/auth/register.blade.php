
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
          <form method="POST" action="{{ route('register') }}" class="col-lg-6 col-md-8 col-10 mx-auto shadow-lg rounded p-5">
              @csrf

            <div class="mx-auto text-center my-4">

                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('website.home') }}">
                  <img src="{{ asset('images/settings/' . $setting->logo) }}" style="width: 100px;" alt="">
                </a>
                <h1 class="h6 mb-3" style="font-size: 20px;">{{ __('words.register') }}</h1>

            </div>

                <div class="row mb-5">
                    
                    <div class="col-md-6">
                        <label for="name" class=" col-form-label text-md-end">{{ __('words.name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class=" col-form-label text-md-end">{{ __('words.email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class=" col-form-label text-md-end">{{ __('words.phone') }}</label>
                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="governorate" class=" col-form-label text-md-end">{{ __('words.governorate') }}</label>
                        <select name="governorate" id="governorate" class="form-control @error('governorate') is-invalid @enderror" value="{{ old('governorate') }}">
                            <option value="" selected disabled>{{ __('words.select') }}</option>
                            @foreach ($governorates as  $governorate )
                                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                            @endforeach
                        </select>

                        @error('governorate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class=" col-form-label text-md-end">{{ __('words.password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="password-confirm" class=" col-form-label text-md-end">{{ __('words.confirmPassword') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>


 
            <input type="submit"  class="btn btn-lg btn-success btn-block mb-5" value="{{ __('words.register') }}">
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