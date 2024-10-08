@extends('dashboard.layout.master')

@section('title')
{{ __('words.categories') }}
@endsection

@section('styles')    
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
    @endif

    
<form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row">


        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
              <label for="name_en"> Name</label>
              <input name="name_en" type="text" class="form-control" id="name_en" aria-describedby="emailHelp">
            </div>
        </div>
        
        <div class="col-12 col-lg-6">
            <div class="form-group mb-3">
              <label for="name_ar">الاسم</label>
              <input name="name_ar" type="text" class="form-control" id="name_ar" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="custom-file mb-3">
                <input name="image" type="file" class="custom-file-input" id="image" aria-describedby="emailHelp">
                <label for="image" class="custom-file-label">{{ __('words.image') }}</label>
            </div>
        </div>

        <div class="col-12 mb-3">
            <button type="submit" class="btn btn-primary">{{ __('words.save') }}</button>
        </div>

    </div>

</form>

@endsection

@section('scripts')
@endsection
