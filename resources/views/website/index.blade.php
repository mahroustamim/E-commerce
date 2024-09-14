<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $setting->name_en }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @if (app()->getLocale() === 'en')
        <meta content="{{ $setting->content_en }}" name="description">
    @else
    <meta content="{{ $setting->content_ar }}" name="description">
    @endif


    <!-- Favicon -->
    <link href="{{ asset('images/settings/' . $setting->favicon) }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('websiteAsset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/notify/css/notifIt.css') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('websiteAsset/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="{{ route('website.home') }}" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><img src="{{ asset('images/settings/' . $setting->favicon) }} " class="mx-100 mr-3" style="width: 50px;" alt="">{{ $setting->name_en}}</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="{{ __('words.search') }}">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">

            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 mb-3">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0" @if (app()->getLocale() === 'ar') dir="rtl" @endif>

                            <a href="{{ route('website.home') }}" class="nav-item nav-link active">{{ __('words.home') }}</a>
                            <a href="{{ route('website.categories') }}" class="nav-item nav-link">{{ __('words.categories') }}</a>
                            {{-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </div>
                            </div> --}}
                            <a href="contact.html" class="nav-item nav-link">{{ __('words.products') }}</a>
                            <a href="contact.html" class="nav-item nav-link">{{ __('words.about') }}</a>
                            <a href="contact.html" class="nav-item nav-link">{{ __('words.contact') }}</a>

                        </div>
                        @if (Auth::check())
                            <div class="navbar-nav ml-auto py-0">
                                <a href="{{ route('website.profile', auth()->user()->id) }}" class="nav-item nav-link">{{ auth()->user()->name }}</a>
                            </div>
                        @else
                            <div class="navbar-nav ml-auto py-0">
                                <a href="{{ route('login') }}" class="nav-item nav-link">{{ __('words.login') }}</a>
                                <a href="{{ route('register') }}" class="nav-item nav-link">{{ __('words.register') }}</a>
                            </div>
                        @endif
                    </div>
                </nav>

                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="{{ asset('websiteAsset/img/slider_1.jpg') }}" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{ __('words.fashionableProducts') }}</h3>
                                    <a href="" class="btn btn-light py-2 px-3">{{ __('words.showNow') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="{{ asset('websiteAsset/img/slider_2.jpg') }}" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{ __('words.reasonablePrice') }}</h3>
                                    <a href="" class="btn btn-light py-2 px-3">{{ __('words.showNow') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">{{ __('words.qualityProduct') }}</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">{{ __('words.freeShipping') }}</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">{{ __('words.securePayment') }}</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">{{ __('words.24/7Support') }}</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">

            @foreach ($categories as $category)
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">{{ $category->products_count }} {{ __('words.products') }}</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="{{ asset('images/categories/' . $category->image) }}" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">{{ $category->name }}</h5>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">

        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">{{ __('words.products') }}</span></h2>
        </div>

        <div class="row px-xl-5 pb-3">

            @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{ asset('images/products/main/' . $product->photo) }}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{ $product->price }}</h6><h6 class="text-muted ml-2"><del>{{ $product->price + $product->discount }}</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
    <!-- Products End -->




    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">

            <div class="col-lg-6 col-md-12 mb-5">
                <a href="{{ route('website.home') }}" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold mb-3"><img src="{{ asset('images/settings/' . $setting->favicon) }} " class="mx-100 mr-3" style="width: 50px;" alt="">{{ $setting->name_en}}</h1>
                </a>
                @if (app()->getLocale() === 'en')
                    <p>{{ $setting->content_en }}</p>
                @else
                    <p>{{ $setting->content_ar }}</p>
                @endif
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $setting->email }}</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ $setting->phone }}</p>
            </div>
            <div class="col-md-6 col-lg-3 mb-5">
                <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                    <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                    <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                    <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                    <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-5">
                <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-dark mb-2" href="{{ route('login') }}"><i class="fa fa-angle-right mr-2"></i>{{ __('words.login') }}</a>
                    <a class="text-dark mb-2" href="{{ route('register') }}"><i class="fa fa-angle-right mr-2"></i>{{ __('words.register') }}</a>
                    @auth
                    <a class="text-dark mb-2" href="{{ route('website.profile', auth()->user()->id) }}"><i class="fa fa-angle-right mr-2"></i>{{ __('words.profile') }}</a>
                    @endauth
                    <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                    <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                    <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="{{ route('website.home') }}">{{ $setting->name_en }}</a>. {{ __('words.allRights') }}. 
                    {{ __('words.designedBy') }}
                    <a class="text-dark font-weight-semi-bold" href="https://github.com/mahroustamim">{{ __('words.mahrous') }}</a><br>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('websiteAsset/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('websiteAsset/lib/owlcarousel/owl.carousel.min.js') }}"></script>


    <!-- Contact Javascript File -->
    <script src="{{ asset('websiteAsset/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('websiteAsset/mail/contact.js') }}"></script>

    <script src='{{ asset('adminAsset/plugins/notify/js/notifIt.js') }}'></script>
    <script src='{{ asset('adminAsset/plugins/notify/js/notifit-custom.js') }}'></script>

    <!-- Template Javascript -->
    <script src="{{ asset('websiteAsset/js/main.js') }}"></script>

</body>

</html>