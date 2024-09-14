@extends('website.layout.master')

@section('content')
    <div class="container-fluid" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="row py-3 px-xl-5">
            <!-- About Page Content Start -->
            <div class="col-lg-6 col-md-12 mb-4">
                <h2 class="font-weight-bold text-center">{{ __('words.about_us') }}</h2>
                <p class="lead">
                    {{ __('words.about_line1') }}
                </p>
                <p>
                    {{ __('words.about_line2') }}
                </p>
                <p>
                    {{ __('words.about_line3') }}
                </p>
                <p>
                    {{ __('words.about_line4') }}
                </p>
            </div>
            <div class="col-lg-6 col-md-12 mb-4">
                <img src="{{ asset('websiteAsset/img/about.jpg') }}" alt="About Us" class="img-fluid rounded">
            </div>
            <!-- About Page Content End -->
        </div>
    </div>
@endsection

@section('scripts')
@endsection
