@extends('dashboard.layout.master')

@section('title')
    {{ __('words.products') }}
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

<form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ __('words.edit') . ' ' . __('words.product') }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="name_en">Name</label>
                        <input type="text" class="form-control" id="name_en" name="name_en" value="{{ $product->name_en }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="name_ar">الاسم</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ $product->name_ar }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="brand_en">Brand</label>
                        <input type="text" class="form-control" id="brand_en" name="brand_en" value="{{ $product->brand_en }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="brand_ar">البراند</label>
                        <input type="text" class="form-control" id="brand_ar" name="brand_ar" value="{{ $product->brand_ar }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="category">{{ __('words.category') }}</label>
                        <select name="category_id" id="category" class="form-control">
                            <option value="" selected disabled>-- {{ __('words.selectCategory') }}--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="price">{{ __('words.price') }}</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="quantity">{{ __('words.quantity') }}</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="discount">{{ __('words.discount') }}</label>
                        <input type="number" class="form-control" id="discount" name="discount" value="{{ $product->discount }}">
                    </div>
                </div>
    
    
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="colors">{{ __('words.colors') }}</label>
                        <select name="colors[]" id="colors" class="form-control select2" multiple>
                            <option value="red" {{in_array('red', $product->colors) ? 'selected' : '' }}>{{ __('words.red') }}</option>
                            <option value="white" {{ in_array('white', $product->colors) ? 'selected' : '' }}>{{ __('words.white') }}</option>
                            <option value="black" {{ in_array('black', $product->colors) ? 'selected' : '' }}>{{ __('words.black') }}</option>
                            <option value="blue" {{ in_array('blue', $product->colors) ? 'selected' : '' }}>{{ __('words.blue') }}</option>
                            <option value="green" {{ in_array('green', $product->colors) ? 'selected' : '' }}>{{ __('words.green') }}</option>
                            <option value="yellow" {{ in_array('yellow', $product->colors) ? 'selected' : '' }}>{{ __('words.yellow') }}</option>
                            <option value="grey" {{ in_array('grey', $product->colors) ? 'selected' : '' }}>{{ __('words.grey') }}</option>
                            <option value="orange" {{ in_array('orange', $product->colors) ? 'selected' : '' }}>{{ __('words.orange') }}</option>
                            <option value="olive" {{ in_array('olive', $product->colors) ? 'selected' : '' }}>{{ __('words.olive') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="sizes">{{ __('words.sizes') }}</label>
                        <select name="sizes[]" id="sizes" class="form-control select2" multiple>
                            <option value="XS" {{in_array('XL', $product->sizes) ? 'selected' : '' }}>XS</option>
                            <option value="S" {{in_array('S', $product->sizes) ? 'selected' : '' }}>S</option>
                            <option value="M" {{in_array('M', $product->sizes) ? 'selected' : '' }}>M</option>
                            <option value="L" {{in_array('L', $product->sizes) ? 'selected' : '' }}>L</option>
                            <option value="XL" {{in_array('XL', $product->sizes) ? 'selected' : '' }}>XL</option>
                            <option value="2XL" {{in_array('2Xl', $product->sizes) ? 'selected' : '' }}>2XL</option>
                            <option value="3XL" {{in_array('3XL', $product->sizes) ? 'selected' : '' }}>3XL</option>
                            <option value="4XL" {{in_array('4XL', $product->sizes) ? 'selected' : '' }}>4XL</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="example-textarea">description</label>
                        <textarea name="desc_en" class="form-control" id="example-textarea" rows="4">{{ $product->desc_en }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="example-textarea">الوصف</label>
                        <textarea name="desc_ar" class="form-control" id="example-textarea" rows="4">{{ $product->desc_ar }}</textarea>
                    </div>
                </div>

                <div class="col-12">
                    <div class="custom-file mb-3">
                        <input name="photo" type="file" class="custom-file-input" id="photo" aria-describedby="emailHelp" onchange="previewSingleImage(event)">
                        <label for="photo" class="custom-file-label">{{ __('words.photo') }}</label>
                    </div>
                </div>
                <div class="col-12">
                    <img id="photo-preview" src="{{ asset('images/products/main/' . $product->photo) }}" alt="Image Preview" style="max-width: 20%; height: auto; margin-top: 10px;" />
                </div>
                
                <div class="col-12">
                    <div class="custom-file mb-3">
                        <input name="name[]" type="file" class="custom-file-input" id="image" aria-describedby="emailHelp" multiple onchange="previewMultipleImages(event)">
                        <label for="image" class="custom-file-label">{{ __('words.images') }}</label>
                    </div>
                    <div id="image-preview" class="row mt-3">
                        <!-- Display existing images here -->
                        @foreach($product->image as $item)
                            <div class="col-3">
                                <img src="{{ asset('images/products/' . $product->id . '/' . $item->name) }}" alt="Image Preview" style="max-width: 100%; height: auto; margin-bottom: 10px;">
                            </div>
                        @endforeach
                    </div>
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
<script>
    // Function for single image preview
    function previewSingleImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function(){
            var img = document.getElementById('photo-preview');
            img.src = reader.result;
            img.style.display = 'block';
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Function for multiple images preview
    function previewMultipleImages(event) {
        var input = event.target;
        var previewContainer = document.getElementById('image-preview');
        previewContainer.innerHTML = ""; // Clear any existing previews

        if (input.files) {
            Array.from(input.files).forEach(function(file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var imgDiv = document.createElement('div');
                    imgDiv.classList.add('col-3'); // Adjust column width as needed

                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    img.style.height = 'auto';
                    img.style.marginBottom = '10px';

                    imgDiv.appendChild(img);
                    previewContainer.appendChild(imgDiv);
                };

                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endsection
