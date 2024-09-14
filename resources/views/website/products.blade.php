@extends('website.layout.master')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12 mb-5">
                
                <form method="get" action="{{ (route('website.products')) }}">
                @csrf


                <div class="input-group mb-4">
                    <input type="text" name="name" placeholder="{{ __('words.search') }}" class="form-control" value="{{ isset($name) ? $name : '' }}">
                </div>

                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">{{ __('words.filter_by_price') }}</h5>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="price[]" value="all" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">{{ __('words.all') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="price[]" value="0-100" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="0-100">0 - 100</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="price[]" value="100-200" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">100 - 200</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="price[]" value="200-300" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">200 - 300</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="price[]" value="300-400" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">300 - 400</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" name="price[]" value="400-500" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">400 - 500</label>
                        </div>
                </div>
                <!-- Price End -->
                
                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">{{ __('words.filter_by_color') }}</h5>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="all" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="color-all">{{ __('words.all') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="black" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">{{ __('words.black') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="white" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">{{ __('words.white') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="red" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">{{ __('words.red') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="blue" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">{{ __('words.blue') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="green" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">{{ __('words.green') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="yellow" class="custom-control-input" id="color-6">
                            <label class="custom-control-label" for="color-6">{{ __('words.yellow') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="orange" class="custom-control-input" id="color-7">
                            <label class="custom-control-label" for="color-7">{{ __('words.orange') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="grey" class="custom-control-input" id="color-8">
                            <label class="custom-control-label" for="color-8">{{ __('words.grey') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="colors[]" value="olive" class="custom-control-input" id="color-9">
                            <label class="custom-control-label" for="color-9">{{ __('words.olive') }}</label>
                        </div>
                </div>
                <!-- Color End -->


                <!-- Size Start -->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">{{ __('words.filter_by_size') }}</h5>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="sizes[]" value="all" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">{{ __('words.all') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="sizes[]" value="XS" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="sizes[]" value="S" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="sizes[]" value="M" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="sizes[]" value="L" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" name="sizes[]" value="XL" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                </div>
                <!-- Size End -->

                <input type="submit" value="{{ __('words.search') }}" class="btn btn-success">
            </form>

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">

                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="{{ asset('images/products/main/' . $product->photo) }}" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>{{ $product->price }}</h6><h6 class="text-muted ml-2"><del>{{ $product->price + $product->discount }}</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <!-- Render pagination links -->
    <div class="d-flex justify-content-center">
        {!! $products->links() !!}
    </div>


@endsection

@section('scripts')
@endsection