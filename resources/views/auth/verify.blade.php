
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
  <body class="light rtl ">



    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg p-5" style="width: 800px;">
                    <div class="card-header text-dark" style="font-size: 20px">{{ __('words.verify_email') }}</div>

                    <div class="card-body text-dark" style="font-size: 15px;">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('words.fresh_verification_link') }}
                            </div>
                        @endif
                    
                        {{ __('words.check_email_verification') }}
                        {{ __('words.did_not_receive_email') }},
                    </div>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('words.click_here_to_request_another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
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

