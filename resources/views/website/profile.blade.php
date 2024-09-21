@extends('website.layout.master')

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

<form  method="POST" action="{{ route('website.profile.update', $user->id) }}" class="shadow-lg p-5">
    @csrf

    <div class="row px-xl-5 pt-5 container-fluid">

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
    </div>
    

    <div class="col-6">
        <input type="submit" value="{{ __('words.save') }}" class="btn btn-success">
    </div>


    </div>  {{-- End row  --}}
</form> 


<hr class="m-5"></hr>


<form action="{{ route('logout') }}" method="POST" class=""> <!-- Add action and method -->
    @csrf <!-- Include CSRF token for security -->
    <div class="p-5 shadow-lg"> <!-- Fixed typo: shdow-lg to shadow-lg -->
        <div class="row px-xl-5 container-fluid">
            <input type="submit" class="btn btn-danger" value="{{ __('words.logout') }}">
        </div>
    </div>
</form>


@endsection



@section('scripts')

@endsection