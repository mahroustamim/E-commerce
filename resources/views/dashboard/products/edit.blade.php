@extends('dashboard.layouts.master')

@section('title')
    المنتجات
@endsection

@section('css')

@endsection

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

<main role="main" class="main-content">
    <div class="container-fluid">

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header">
              <strong class="card-title">تعديل منتج</strong>
            </div>
            <form action="{{ route('dashboard.products.update', $product->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label for="simpleinput">الاسم</label>
                    <input name="name" type="text" value="{{ $product->name }}" id="simpleinput" class="form-control">
                  </div>
                  <div class="form-group mb-3">
                    <label for="example-select">القسم</label>
                    <select name="category_id" class="form-control" id="example-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label for="example-password">السعر</label>
                    <input name="price" type="number"  value="{{ $product->price }}" id="example-password" class="form-control" value="password">
                  </div>

                  <div class="form-group mb-3">
                    <label for="example-palaceholder">الخصم</label>
                    <input name="discount" type="number" value="{{ $product->discount }}" id="example-palaceholder" class="form-control">
                  </div>
                </div> <!-- /.col -->

                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label for="example-helping">الكمية</label>
                    <input name="quantity" type="number" value="{{ $product->quantity }}" id="example-helping" class="form-control" >
                  </div>

                  <div class="form-group mb-3">
                    <label for="colors">الالوان</label>
                    <select name="colors[]" id="colors" class="form-control select2" multiple="multiple">
                      <option value="الاحمر" {{ in_array('الاحمر', $product->colors) ? 'selected' : '' }}>الاحمر</option>
                      <option value="الازرق" {{ in_array('الازرق', $product->colors) ? 'selected' : '' }}>الازرق</option>
                      <option value="الاحضر" {{ in_array('الاحضر', $product->colors) ? 'selected' : '' }}>الاحضر</option>
                      <option value="الاصفر" {{ in_array('الاصفر', $product->colors) ? 'selected' : '' }}>الاصفر</option>
                      <option value="الرمادي" {{ in_array('الرمادي', $product->colors) ? 'selected' : '' }}>الرمادي</option>
                      <option value="البرتقالي" {{ in_array('البرتقالي', $product->colors) ? 'selected' : '' }}>البرتقالي</option>
                      <option value="الزيتوني" {{ in_array('الزيتوني', $product->colors) ? 'selected' : '' }}>الزيتوني</option>
                    </select>
                </div>
            
                <div class="form-group mb-3">
                    <label for="sizes">الاحجام</label>
                    <select name="sizes[]" id="sizes" class="form-control select2" multiple="multiple">
                      <option value="XS" {{ in_array('XS', $product->sizes) ? 'selected' : '' }}>XS</option>
                      <option value="S" {{ in_array('S', $product->sizes) ? 'selected' : '' }}>S</option>
                      <option value="M" {{ in_array('M', $product->sizes) ? 'selected' : '' }}>M</option>
                      <option value="L" {{ in_array('L', $product->sizes) ? 'selected' : '' }}>L</option>
                      <option value="XL" {{ in_array('XL', $product->sizes) ? 'selected' : '' }}>XL</option>
                      <option value="2XL" {{ in_array('2XL', $product->sizes) ? 'selected' : '' }}>2XL</option>
                      <option value="3XL" {{ in_array('3XL', $product->sizes) ? 'selected' : '' }}>3XL</option>
                      <option value="4XL" {{ in_array('4XL', $product->sizes) ? 'selected' : '' }}>4XL</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                  <label for="example-textarea">الوصف</label>
                  <textarea name="desc" class="form-control"  id="example-textarea" rows="4">{{ $product->desc }}</textarea>
                </div>


                </div>
            </div>

            <input type="submit" value="حفظ البيانات" class="btn btn-primary">
        </div> <!-- / card body -->
        
        </form>
    </div> <!-- / .card -->

    </div>
</main>
@endsection

@section('scripts')

@endsection