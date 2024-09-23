@extends('website.layout.master')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid pt-5">

        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif

        
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12 mb-5 shadow-lg p-5">
                
                <form method="get" action="{{ (route('website.products')) }}">
                @csrf


                <div class="input-group mb-4">
                    <input type="text" name="name" placeholder="{{ __('words.search') }}" class="form-control" value="{{ isset($name) ? $name : '' }}">
                </div>

                <div class="accordion" id="accordionExample">

                    <!-- Price Start -->
                    <div class="card mb-4">
                        <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                {{ __('words.filter_by_price') }}
                            </button>
                          </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                
                                <div class="border-bottom mb-4 pb-4">
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="checkbox" name="price[]" value="all" class="custom-control-input"  id="price-all" {{ in_array('all', $selectedPrices) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="price-all">{{ __('words.all') }}</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="checkbox" name="price[]" value="0-100" class="custom-control-input" id="price-1" {{ in_array('0-100', $selectedPrices) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="price-1">0 - 100</label>
                                    </div>
                                    
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="checkbox" name="price[]" value="100-200" class="custom-control-input" id="price-2" {{ in_array('100-200', $selectedPrices) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="price-2">100 - 200</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="checkbox" name="price[]" value="200-300" class="custom-control-input" id="price-3" {{ in_array('200-300', $selectedPrices) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="price-3">200 - 300</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="checkbox" name="price[]" value="300-400" class="custom-control-input" id="price-4" {{ in_array('300-400', $selectedPrices) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="price-4">300 - 400</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                        <input type="checkbox" name="price[]" value="400-500" class="custom-control-input" id="price-5" {{ in_array('400-500', $selectedPrices) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="price-5">400 - 500</label>
                                    </div>
                            </div>

                            </div>
                        </div>
                    </div>
                    <!-- Price End -->

                    <!-- Color Start -->
                    <div class="card mb-4">
                        <div class="card-header" id="headingTwo">
                          <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                {{ __('words.filter_by_color') }}
                            </button>
                          </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                          <div class="card-body">
                            <div class="border-bottom mb-4 pb-4">
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="all" class="custom-control-input"  id="color-all" {{ in_array('all', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-all">{{ __('words.all') }}</label>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="black" class="custom-control-input" id="color-1" {{ in_array('black', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-1">{{ __('words.black') }}</label>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="white" class="custom-control-input" id="color-2" {{ in_array('white', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-2">{{ __('words.white') }}</label>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="red" class="custom-control-input" id="color-3" {{ in_array('red', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-3">{{ __('words.red') }}</label>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="blue" class="custom-control-input" id="color-4" {{ in_array('all', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-4">{{ __('words.blue') }}</label>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="green" class="custom-control-input" id="color-5" {{ in_array('green', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-5">{{ __('words.green') }}</label>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="yellow" class="custom-control-input" id="color-6" {{ in_array('yellow', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-6">{{ __('words.yellow') }}</label>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="orange" class="custom-control-input" id="color-7" {{ in_array('orange', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-7">{{ __('words.orange') }}</label>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="grey" class="custom-control-input" id="color-8" {{ in_array('grey', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-8">{{ __('words.grey') }}</label>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="colors[]" value="olive" class="custom-control-input" id="color-9" {{ in_array('olive', $selectedColors) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="color-9">{{ __('words.olive') }}</label>
                                </div>
                        </div>
                          </div>
                        </div>
                      </div>
                      <!-- Color End -->

                <!-- Size Start -->

                <div class="card mb-4">
                    <div class="card-header" id="headingThree">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            {{ __('words.filter_by_size') }}
                        </button>
                      </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="mb-5">
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" name="sizes[]" value="all" class="custom-control-input"  id="size-all" {{ in_array('all', $selectedSizes) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="size-all">{{ __('words.all') }}</label>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" name="sizes[]" value="XS" class="custom-control-input" id="size-1" {{ in_array('XL', $selectedSizes) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="size-1">XS</label>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" name="sizes[]" value="S" class="custom-control-input" id="size-2" {{ in_array('S', $selectedSizes) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="size-2">S</label>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" name="sizes[]" value="M" class="custom-control-input" id="size-3" {{ in_array('M', $selectedSizes) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="size-3">M</label>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" name="sizes[]" value="L" class="custom-control-input" id="size-4" {{ in_array('L', $selectedSizes) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="size-4">L</label>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" name="sizes[]" value="XL" class="custom-control-input" id="size-5" {{ in_array('XL', $selectedSizes) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="size-5">XL</label>
                            </div>
                    </div>
                      </div>
                    </div>
                  </div>

                <!-- Size End -->

                </div>

                

                
            

                <input type="submit" value="{{ __('words.search') }}" class="btn btn-success">
            </form>

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">

                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4 shadow-lg">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="{{ asset('images/products/main/' . $product->photo) }}" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>{{ $product->price }} £</h6><h6 class="text-muted ml-2"><del>{{ $product->price + $product->discount }} £</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center bg-light border">
                                    <a href="{{ route('website.cart', $product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>{{ __('words.view_details') }}</a>
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