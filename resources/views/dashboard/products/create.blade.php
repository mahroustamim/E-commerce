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

<form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ __('words.add') . ' ' . __('words.product') }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="name_en">Name</label>
                        <input type="text" class="form-control" id="name_en" name="name_en">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="name_ar">الاسم</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="brand_en">Brand</label>
                        <input type="text" class="form-control" id="brand_en" name="brand_en">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="brand_ar">البراند</label>
                        <input type="text" class="form-control" id="brand_ar" name="brand_ar">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="category">{{ __('words.category') }}</label>
                        <select name="category_id" id="category" class="form-control">
                            <option value="" selected disabled>-- {{ __('words.selectCategory') }}--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="price">{{ __('words.price') }}</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="quantity">{{ __('words.quantity') }}</label>
                        <input type="number" class="form-control" id="quantity" name="quantity">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="discount">{{ __('words.discount') }}</label>
                        <input type="number" class="form-control" id="discount" name="discount">
                    </div>
                </div>
    
    
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="colors">{{ __('words.colors') }}</label>
                        <select name="colors[]" id="colors" class="form-control select2" multiple>
                            <option value="red">{{ __('words.red') }}</option>
                            <option value="white">{{ __('words.white') }}</option>
                            <option value="black">{{ __('words.black') }}</option>
                            <option value="blue">{{ __('words.blue') }}</option>
                            <option value="green">{{ __('words.green') }}</option>
                            <option value="yellow">{{ __('words.yellow') }}</option>
                            <option value="grey">{{ __('words.grey') }}</option>
                            <option value="orange">{{ __('words.orange') }}</option>
                            <option value="olive">{{ __('words.olive') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="sizes">{{ __('words.sizes') }}</label>
                        <select name="sizes[]" id="sizes" class="form-control select2" multiple>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="2XL">2XL</option>
                            <option value="3XL">3XL</option>
                            <option value="4XL">4XL</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="example-textarea">description</label>
                        <textarea name="desc_en" class="form-control" id="example-textarea" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="example-textarea">الوصف</label>
                        <textarea name="desc_ar" class="form-control" id="example-textarea" rows="4"></textarea>
                    </div>
                </div>

                <div class="col-12">
                    <div class="custom-file mb-3">
                        <input name="photo" type="file" class="custom-file-input" id="photo" aria-describedby="emailHelp" onchange="previewSingleImage(event)">
                        <label for="photo" class="custom-file-label">{{ __('words.photo') }}</label>
                    </div>
                </div>
                <div class="col-12">
                    <img id="photo-preview" src="#" alt="Image Preview" style="display: none; max-width: 20%; height: auto; margin-top: 10px;" />
                </div>
                
                <div class="col-12">
                    <div class="custom-file mb-3">
                        <input name="name[]" type="file" class="custom-file-input" id="image" aria-describedby="emailHelp" multiple onchange="previewMultipleImages(event)">
                        <label for="image" class="custom-file-label">{{ __('words.images') }}</label>
                    </div>
                    <div id="image-preview" class="row mt-3"></div>
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
