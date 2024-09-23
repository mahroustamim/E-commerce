@extends('website.layout.master')

@section('content')
<script src="https://js.stripe.com/v3/"></script>

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
<div class="container-fluid pt-5" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Use 'id' for form for Stripe integration -->
    <form id="payment-form" action="{{ route('website.order.store') }}" method="POST" class="form">
        @csrf

        <div class="row px-xl-5 shadow-lg p-5">
            <!-- Shipping Address Section -->
            <div class="col-lg-8">
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
                                    <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>{{ __('words.address') }}</label>
                            <input name="address" class="form-control" type="text">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>{{ __('words.postal_code') }}</label>
                            <input name="postal_code" class="form-control" type="text">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary and Payment Section -->
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

                <!-- Stripe Payment Fields -->
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">{{ __('words.payment') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- Stripe's card element will go here -->
                            </div>
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="submit btn btn-lg btn-block btn-success font-weight-bold my-3 py-3">{{ __('words.checkout') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="stripeToken" id="stripeToken">

    </form>
</div>
<!-- Checkout End -->
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Update subtotal and total
        function updateSubtotalAndTotal() {
            let subtotal = 0;
            let total = 0;
            document.querySelectorAll('.cart_price').forEach(ele => {
                subtotal += parseInt(ele.innerText);
                total += parseInt(ele.innerText);
            });
            total += parseInt(document.querySelector('.shipping').innerText);
            document.querySelector('.subtotal').childNodes[0].nodeValue = subtotal;
            document.querySelector('.total').childNodes[0].nodeValue = total;
        }

        let governorate = document.querySelector('.governorate');
        let baseUrl = '{{ url("/website") }}';

        governorate.addEventListener('change', function() {
            let url = `${baseUrl}/delivery-price/${governorate.value}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector('.shipping').childNodes[0].nodeValue = data.delivery_price;
                    document.querySelector('.input_shipping').value = data.delivery_price;
                    updateSubtotalAndTotal();
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Initialize Stripe
        var stripe = Stripe("{{ env('STRIPE_PUBLISHABLE_KEY') }}");
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSize: '16px',
                '::placeholder': { color: '#aab7c4' }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        var card = elements.create('card', {style: style});
        card.mount('#card-element');

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    var hiddenInput = document.getElementById('stripeToken');
                    hiddenInput.value = result.token.id;
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
