

@extends('website.layout.master')

@section('content')

<div class="row px-xl-5 pt-5">
    <div class="col-md-12 text-center">
        <img src="{{ asset('websiteAsset/img/tick mark.jpg') }}" class="mw-100" style="width: 100px;" alt="">
        <h2>{{ __('words.thank_you') }}</h2>
        <p>{{ __('words.order_completed') }}</p>
        <a href="{{ route('website.home') }}" class="btn btn-success rounded">{{ __('words.back_to_shop') }}</a>
        
    </div>
</div>
@endsection

@section('scripts')
@endsection