@extends('dashboard.layouts.master')

@section('title')
    الاعدادات
@endsection

@section('css')
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

   
    <main role="main" class="main-content">
        <div class="container-fluid">

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

                <div class="col-12 col-lg-6 mb-3">
                    <img id="logoPreview" src="{{ asset($setting->logo ?? 'path/to/default-logo.png') }}" alt="مراجعة الصورة" style="width: 50px; height: auto;">
                </div>
                
                <div class="col-12 col-lg-6 mb-3">
                    <img id="faviconPreview" src="{{ asset($setting->favicon ?? 'path/to/default-favicon.png') }}" alt="مراجعة الصورة" style="width: 50px; height: auto;">
                </div>
                
                <div class="col-12 col-lg-6">
                    <div class="custom-file mb-3">
                        <input name="logo" type="file" class="custom-file-input" id="logo" aria-describedby="emailHelp" onchange="previewImage(this, 'logoPreview')">
                        <label for="logo" class="custom-file-label">الشعار</label>
                    </div>
                </div>
                
                <div class="col-12 col-lg-6">
                    <div class="custom-file mb-3">
                        <input name="favicon" type="file" class="custom-file-input" id="favicon" onchange="previewImage(this, 'faviconPreview')">
                        <label for="favicon" class="custom-file-label">الصورة المصغرة</label>
                    </div>
                </div>
                

                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                      <label for="name">إسم الموقع</label>
                      <input name="name" value="{{ $setting->name }}" type="text" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                      <label for="email">البريد الاكتروني</label>
                      <input value="{{ $setting->email }}" name="email" type="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                      <label for="facebook">فيسبوك</label>
                      <input value="{{ $setting->facebook }}" name="facebook" type="text" class="form-control" id="facebook" aria-describedby="emailHelp">
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                      <label for="instagram">إنستغرام</label>
                      <input value="{{ $setting->instagram }}" name="instagram" type="text" class="form-control" id="instagram">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                      <label for="twitter">تويتر</label>
                      <input value="{{ $setting->twitter }}" name="twitter" type="text" class="form-control" id="twitter" >
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                      <label for="phone">الهاتف</label>
                      <input value="{{ $setting->phone }}" name="phone" type="number" class="form-control" id="phone">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                      <label for="content">الوصف</label>
                      <textarea name="content" id="content" cols="50" rows="4"> {{ $setting->content }} </textarea>
                    </div>
                </div>

                </div>

                <button type="submit" class="btn btn-primary">حفظ البيانات</button>

            </form>


        </div>
    </main>
@endsection

@section('scripts')

<script>
    function previewImage(inputElement, previewId) {
        var file = inputElement.files[0];
        if (file) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                var previewElement = document.getElementById(previewId);
                previewElement.src = e.target.result;
            }
            
            reader.readAsDataURL(file);
        }
    }
    </script>
    

@endsection