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

    @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
    @endif

        <!-- Contact Start -->
        <div class="container-fluid pt-5" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">{{ __('words.contact_for_any_queries') }}</span></h2>
            </div>
            <div class="row px-xl-5 shadow-lg p-5">
                <div class="col-lg-7 mb-5">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form method="POST" action="{{ route('website.contact') }}">
                            @csrf

                            <div class="control-group mb-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('words.name') }}" required  />
                            </div>
                            <div class="control-group mb-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="{{ __('words.email') }}" required/>
                            </div>
                            <div class="control-group mb-3">
                                <input type="text" name="subject" class="form-control" id="subject" placeholder="{{ __('words.subject') }}" required/>
                            </div>
                            <div class="control-group mb-3">
                                <textarea class="form-control" name="message" rows="6" id="message" placeholder="{{ __('words.message') }}" required></textarea>
                            </div>
                            <div>
                                <input type="submit" id="sendMessageButton" class="btn btn-success py-2 px-4" value="{{ __('words.send_message') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-5">
                    <div class="map_container" style="position: relative; overflow: hidden; padding-bottom: 56.25%; height: 0;">
                        <iframe 
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France"
                            width="600" 
                            height="450" 
                            frameborder="0" 
                            style="border:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Contact End -->
@endsection

@section('scripts')
@endsection