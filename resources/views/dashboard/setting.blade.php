@extends('dashboard.layout.master')

@section('title')
    {{ __('words.settings') }}
@endsection

@section('styles')    
@endsection

@section('content')

@if (session('success'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ session('success') }}",
                type: "success"
            });
        }
    </script>
@endif

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif

<form action="{{ route('dashboard.settings.updateOrCreate') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row">

        <div class="col-12 col-lg-6">
            <div class="form-groub mb-3">
                <img src="{{ asset('images/settings/' . $setting->logo) }}" alt="" style="width: 100px; height: auto;">
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-groub mb-3">
                <img src="{{ asset('images/settings/' . $setting->favicon) }}" alt="" style="width: 100px; height: auto;">
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="custom-file mb-3">
                <input name="logo" type="file" class="custom-file-input" id="logo" aria-describedby="emailHelp">
                <label for="logo" class="custom-file-label">{{ __('words.logo') }}</label>
            </div>
        </div>
    
        <div class="col-12 col-lg-6">
            <div class="custom-file mb-3">
                <input name="favicon" type="file" class="custom-file-input" id="favicon" aria-describedby="emailHelp">
                <label for="favicon" class="custom-file-label">{{ __('words.favicon') }}</label>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
              <label for="name_en">Website Name</label>
              <input name="name_en" value="{{ $setting->name_en }}" type="text" class="form-control" id="name_en" aria-describedby="emailHelp">
            </div>
        </div>
        
        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
              <label for="name_ar">إسم الموقع</label>
              <input name="name_ar" value="{{ $setting->name_ar }}" type="text" class="form-control" id="name_ar" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
                <label for="email">{{ __('words.email') }}</label>
                <input type="email" value="{{ $setting->email }}" name="email" id="email" class="form-control">
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
              <label for="facebook">{{ __('words.facebook') }}</label>
              <input value="{{ $setting->facebook }}" name="facebook" type="text" class="form-control" id="facebook" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
              <label for="instagram">{{ __('words.instagram') }}</label>
              <input value{{ $setting->instagram }} name="instagram" type="text" class="form-control" id="instagram">
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
              <label for="twitter">{{ __('words.twitter') }}</label>
              <input value="{{ $setting->twitter }}" name="twitter" type="text" class="form-control" id="twitter" >
            </div>
        </div>

        <div class="col-12 col-lg-6 ">
            <div class="form-group mb-3">
              <label for="phone">{{ __('words.phone') }}</label>
              <input value="{{ $setting->phone }}" name="phone" type="number" class="form-control" id="phone">
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
                <label for="content_en">description</label>
                <textarea name="content_en" class="form-control" id="conent_en" cols="60" rows="4">{{ $setting->content_en }}</textarea>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
                <label for="content_ar">الوصف</label>
                <textarea name="content_ar" class="form-control" id="conent_ar" cols="60" rows="4">{{ $setting->content_ar }}</textarea>
            </div>
        </div>

    </div>

    <input type="submit" value="{{ __('words.save') }}" class="btn btn-primary">
        
    
</form>



@endsection

@section('scripts')
@endsection
