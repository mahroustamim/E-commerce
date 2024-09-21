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
    @if (session('error'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{ session('error') }}",
                    type: "error"
                });
            }
        </script>
    @endif



        <!-- Checkout Start -->
        <div class="container-fluid pt-5" dir="{{ app()->getlocale() == 'ar' ? 'rtl' : '' }}">

            @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif

        <form action="{{ route('website.order.store') }}" method="POST" class="form">
            @csrf

            <div class="row px-xl-5 shadow-lg p-5">


                <div class="col-lg-8 ">
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">{{ __('words.shipping_address') }}</h4>

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label>{{ __('words.name') }}</label>
                                <input class="form-control" name="name" type="text" value="{{ auth()->user()->name }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{ __('words.email') }}</label>
                                <input name="email" class="form-control" type="email" value="{{ auth()->user()->email }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{ __('words.phone') }}</label>
                                <input name="phone" class="form-control" type="number" value="{{ auth()->user()->phone }}">
                            </div>

                            <input name="shipping" type="hidden" value="" class="input_shipping">
                            <div class="col-md-6 form-group">
                                <label>{{ __('words.governorate') }}</label>
                                <select name="governorate" class="governorate custom-select">
                                    <option selected disabled>{{ __('words.select') }}</option>
                                    @foreach ($governorates as $governorate)
                                    <option value="{{ $governorate->id }}" > {{ $governorate->name }} </option>                                    
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{ __('words.address') }}</label>
                                <input name="address" class="form-control" type="text">
                            </div>
                            
                            <div class="col-md-6 form-group">
                                <label>{{ __('words.postal_code') }}</label>
                                <input name="postal_code" class="form-control" type="text" >
                            </div>


                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">{{ __('words.order_total') }}</h4>
                        </div>
                        <div class="card-body">
                        <h5 class="font-weight-medium mb-3">{{ __('words.products') }}</h5>

                        @foreach ($carts as $cart)
                            
                        <div class="d-flex justify-content-between">
                            <p>{{ $cart->product->{'name_'.app()->getLocale()} }}</p>
                            <p class="cart_price">{{ $cart->product->price * $cart->quantity }} <span>&pound;</span></p>
                        </div>
                        @endforeach

                            <hr class="mt-0">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">{{ __('words.subtotal') }}</h6>
                                <h6 class="subtotal font-weight-medium">0 <span>&pound;</span></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">{{ __('words.shipping') }}</h6>
                                <h6 class="shipping font-weight-medium">0 <span>&pound;</span></h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">{{ __('words.total') }}</h5>
                                <h5 class="total font-weight-bold">0 <span>&pound;</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">{{ __('words.payment') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                    <label class="custom-control-label" for="directcheck">Direct Check</label>
                                </div>
                            </div>
                            <div class="">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                    <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <button type="submit" class="submit btn btn-lg btn-block btn-success font-weight-bold my-3 py-3">{{ __('words.checkout') }}</button>
                        </div>
                    </div>
                </div>
            </div>
             </form>
        </div>
        <!-- Checkout End -->
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        updateSubtotalAndTotal()
        function updateSubtotalAndTotal() {
            let subtotal = 0;
            let total = 0;
            document.querySelectorAll('.cart_price').forEach(ele => {
                subtotal += parseInt(ele.innerText);
                total += parseInt(ele.innerText);
            });
            total += parseInt(document.querySelector('.shipping').innerText);
            // document.querySelector('.subtotal').innerText = price;
            document.querySelector('.subtotal').childNodes[0].nodeValue = subtotal;
            document.querySelector('.total').childNodes[0].nodeValue = total;
        }

        let governorate = document.querySelector('.governorate'); // Assuming you have a class 'governorate'

        let baseUrl = 'http://localhost/projects/E-commerce/public/website';

        // Add event listener to detect change in the governorate selection
        governorate.addEventListener('change', function() {
            // Create the full URL dynamically with the updated value
            let url = `${baseUrl}/delivery-price/${governorate.value}`;

            // Make the fetch request
            fetch(url, {
                method: 'GET', // Change to GET since you are fetching data
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value // Include the CSRF token in the headers (useful for POST)
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector('.shipping').childNodes[0].nodeValue = data.delivery_price;
                    document.querySelector('.input_shipping').value = data.delivery_price;
                    updateSubtotalAndTotal()
                } else {
                    console.log('Failed to retrieve delivery price.');
                }
            })
            .catch(error => console.error('Error:', error));
        });


    })

</script>
@endsection