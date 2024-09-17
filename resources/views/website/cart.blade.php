@extends('website.layout.master')

@section('content')

@if (session('success'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ session('success') }}",
                type: 'success'
            });
        };
    </script>
@endif

    

<style>
    .rating {
        direction: rtl;
        unicode-bidi: bidi-override;
    }
    
    .rating input {
        display: none;
    }
    
    .rating label {
        color: #ddd;
        font-size: 2em;
        cursor: pointer;
    }
    
    .rating input:checked ~ label {
        color: #ffc107;
    }
    
    .rating label:hover,
    .rating label:hover ~ label {
        color: #ffc107;
    }
    </style>

    

    <!-- Shop Detail Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 shadow-lg p-5 mb-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        @foreach ($product->image as $index => $item)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img class="w-100 h-100" src="{{ asset('images/products/' . $product->id . '/' . $item->name) }}" alt="Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
                
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->name}}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{ $product->price }} £</h3>
                <p class="mb-4">{{ $product->desc }}</p>

                <form method="POST" action="{{ route('website.cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="d-flex mb-3">
                        <p class="text-dark font-weight-medium mb-0 mr-3">{{ __('words.sizes') }} :</p>

                            @foreach ($product->sizes as $index => $size)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="{{ $size }}" name="size" value="{{ $size }}" {{ $index == 0 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $size }}">{{ $size }}</label>
                                </div>
                            @endforeach
                    </div>

                    <div class="d-flex mb-4">
                        <p class="text-dark font-weight-medium mb-0 mr-3">{{ __('words.colors') }} :</p>
                            @foreach ($product->colors as $index => $color)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="{{ $color }}" name="color" value="{{ $color }}" {{ $index == 0 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $color }}">{{ app()->getLocale() == 'ar' ? __("words.$color") : $color }}</label>
                                </div>
                            @endforeach
                    </div>

                    <div class="d-flex align-items-center mb-4 pt-2">

                        <div class="input-group quantity mr-3" style="width: 130px;">

                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success btn-minus" >
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>

                            <input type="text" name="quantity" class="form-control bg-secondary text-center" value="1">

                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-success px-3"><i class="fa fa-shopping-cart mr-1"></i>{{ __('words.add_to_cart') }}</button>
                    </div>
                </form>

                <div class="d-flex pt-2">

                    @if ($product->status == 'available')

                        <span class="text-light p-2 rounded font-weight-medium mb-0 mr-2 badge badge-success">{{ __('words.' . $product->status) }}</span>

                        @else

                        <span class="text-light p-2 rounded font-weight-medium mb-0 mr-2 badge badge-danger">{{ __('words.' . $product->status) }}</span>

                    @endif
                    
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                </div>
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                                <div class="media mb-4">
                                    <img src="{{ asset('websiteAsset/img/user.jpg') }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                    </div>
                                </div>
                            </div>
                            {{-- ====================================================================== --}}
                            {{-- ====================================================================== --}}

                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                    
                                <!-- Rating Form -->
                                <form>
                                    <h5>Your Rating * :</h5>
                                    <div class="d-flex my-3">
                                        <div class="rating">
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label for="star5" class="star">&#9733;</label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label for="star4" class="star">&#9733;</label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label for="star3" class="star">&#9733;</label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2" class="star">&#9733;</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" class="star">&#9733;</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Submit Rating" class="btn btn-success px-3">
                                    </div>
                                </form>
                                
                                
                                
                    
                                <!-- Comment Form -->
                                <form class="mt-4">
                                    <div class="form-group">
                                        <label for="comment">Your Comment *</label>
                                        <input type="text" class="form-control" id="comment" name="comment">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-success px-3">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                
                
                @if (!$related_products->isEmpty())
                <div class="owl-carousel related-carousel">

                        @foreach ($related_products as $product)
                            <div class="card product-item border-0">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="{{ asset('images/products/main/' . $product->photo) }}" src="img/product-4.jpg" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{ $prodcut->name }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>{{ $product->price  }}</h6><h6 class="text-muted ml-2"><del>{{ $product->price + $product->discount }}</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    @else


                            <div>{{ __('words.emptyTable') }}</div>

                        
                    @endif
                    
                    
            </div>
        </div>
    </div>
    <!-- Products End -->

@endsection

@section('scripts')

@endsection