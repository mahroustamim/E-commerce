@extends('website.layout.master')

@section('content')

    <!-- Carts Start -->
    <div class="container-fluid pt-5" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>{{ __('words.products') }}</th>
                            <th>{{ __('words.price') }}</th>
                            <th>{{ __('words.quantity') }}</th>
                            <th>{{ __('words.total') }}</th>
                            <th>{{ __('words.delete') }}</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $cart)
                            <tr class="cart">
                                <td class="align-middle"><img src="{{ asset('images/products/main/' . $cart->product->photo) }}" alt="" style="width: 50px;"> {{ $cart->product->{'name_' . app()->getLocale()} }}</td>
                                <td id="price" class="align-middle">{{ $cart->product->price }}</td>
                                <td class="align-middle">
                                    <form id="form-quantity" method="POST" action="{{ route('website.cart.update', $cart->id) }}">
                                        @csrf

                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-success btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input name="quantity" type="text" class="form-control form-control-sm bg-secondary text-center" value="{{ $cart->quantity }}">

                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-success btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                </td>
                                <td id="total" class="align-middle">{{ $cart->product->price * $cart->quantity }}</td>
                                <td class="align-middle">
                                    <form id="cart-delete-form" method="POST" action="{{ route('website.cart.delete', $cart->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fa fa-times"></i>
                                        </button>                                    
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            {{-- ========================================================================== --}}
            <div class="col-lg-4">
                {{-- <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> --}}
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">{{ __('words.cart_summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">{{ __('words.subtotal') }}</h6>
                            <h6 class="subtotal font-weight-medium">0 <span></span></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">{{ __('words.shipping') }}</h6>
                            <h6 class="font-weight-medium">{{ __('words.depend_on') }}</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">{{ __('words.total') }}</h5>
                            <h5 class="total-price font-weight-bold">0 <span></span></h5>
                        </div>
                        @if (auth()->check())
                            <a class="btn btn-block btn-success my-3 py-3" href="{{ route('website.checkout') }}">{{ __('words.buy') }}</a>
                        @else
                            <a class="btn btn-block btn-success my-3 py-3" href="{{ route('login') }}">{{ __('words.buy') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carts End -->

@endsection

{{-- @section('scripts') --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // =======================================================================================
        // ====================================== update quantity ================================
        // =======================================================================================
        updateSubtotalAndTotal()
        function updateSubtotalAndTotal() {
            let price = 0;

            document.querySelectorAll('#total').forEach(ele => {
                price += parseInt(ele.innerText);
            });

            document.querySelector('.subtotal').innerText = price;
            document.querySelector('.total-price').innerText = price;
        }

        // =======================================================================================
        // ====================================== delete cart=====================================
        // =======================================================================================
        // Add an event listener to each delete form
        document.querySelectorAll('#cart-delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                let form = event.target;
                let formData = new FormData(form); // Create a FormData object to include CSRF token
                // formData.append('key', 'value');

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value // Include the CSRF token in the headers
                    },
                    body: formData
                })
                .then(response => response.json()) // Expecting a JSON response
                .then(data => {
                    if (data.success) {
                        // Find the parent <tr> of the form and remove it from the DOM
                        form.closest('tr').remove();
                        document.querySelector('.carts_count').innerText -= 1;
                        notif({
                            msg: data.message,
                            type: 'success'
                        })
                        updateSubtotalAndTotal()
                    } else {
                        console.log('Error removing cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    console.log('Something went wrong, please try again later.');
                });
            });
        });

        // =======================================================================================
        // ====================================== update quantity ================================
        // =======================================================================================
        
    document.querySelectorAll('.btn-plus').forEach(button => {
        button.addEventListener('click', function() {
            let quantityInput = this.closest('tr').querySelector('.quantity input').value;
            let priceEle = this.closest('tr').querySelector('#price').innerText;
            let total = this.closest('tr').querySelector('#total').innerText = quantityInput * priceEle;
            let form = this.closest('tr').querySelector('#form-quantity');

            let data = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },

                body: data,

            }) 
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    notif({
                        msg: data.message,
                        type: 'success',
                    })
                    updateSubtotalAndTotal()
                } else {
                    console.log('Error updata quantity')
                }
            })
            
        });
    });
    // ==============================
    document.querySelectorAll('.btn-minus').forEach(button => {
        button.addEventListener('click', function() {
            let quantityInput = this.closest('tr').querySelector('.quantity input').value;
            let priceEle = this.closest('tr').querySelector('#price').innerText;
            let total = this.closest('tr').querySelector('#total').innerText = quantityInput * priceEle;

            let form = this.closest('tr').querySelector('#form-quantity');

            let data = new FormData(form);
            data.append('key', 'value')

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },

                body: data,

            }) 
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    notif({
                        msg: data.message,
                        type: 'success',
                    })
                    updateSubtotalAndTotal()
                } else {
                    console.log('Error updata quantity')
                }
            })
        });
    });

 
    });
</script>


{{-- @endsection --}}