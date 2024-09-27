@extends('dashboard.layout.master')

@section('title')
    {{ __('words.products') }}
@endsection

@section('styles')    
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
    {{-- <ul> --}}
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    {{-- </ul> --}}
    </div>
    @endif

<form action="{{ route('dashboard.supervisors.update', $user->id) }}" method="post">
    @csrf

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ __('words.add') . ' ' . __('words.supervisor') }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="name" class=" col-form-label text-md-end">{{ __('words.name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
        
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-4">
                    <label for="email" class=" col-form-label text-md-end">{{ __('words.email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-4">
                    <label for="phone" class=" col-form-label text-md-end">{{ __('words.phone') }}</label>
                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" required>
        
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-4">
                    <label for="governorate" class=" col-form-label text-md-end">{{ __('words.governorate') }}</label>
                    <select name="governorate" id="governorate" class="form-control @error('governorate') is-invalid @enderror" value="{{ old('governorate') }}">
                        <option value="" selected disabled>{{ __('words.select') }}</option>
                        @foreach ($governorates as  $governorate )
                            <option value="{{ $governorate->id }}" {{ $user->governorate_id == $governorate->id ? 'selected' : '' }}>{{ $governorate->name }}</option>
                        @endforeach
                    </select>
        
                    @error('governorate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                <div class="col-md-6 mb-4">
                    <label for="password" class=" col-form-label text-md-end">{{ __('words.password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
        
                <div class="col-md-6 mb-4">
                    <label for="password-confirm" class=" col-form-label text-md-end">{{ __('words.confirmPassword') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
                
                <div class="col-3">
                    <input type="submit" class="btn btn-primary w-100" value="{{ __('words.save') }}">
                </div>
                
            </div>
        </div>
    </div>


</form>




@endsection

@section('scripts')
@endsection
