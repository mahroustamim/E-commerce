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
              <strong class="card-title">إضافة منتج</strong>
            </div>
            <form action="{{ route('dashboard.products.store') }}" method="post">
            @csrf

            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label for="simpleinput">الاسم</label>
                    <input name="name" type="text" id="simpleinput" class="form-control">
                  </div>
                  <div class="form-group mb-3">
                    <label for="example-select">القسم</label>
                    <select name="category_id" class="form-control" id="example-select">
                      <option value="" selected disabled>--حدد القسم--</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label for="example-password">السعر</label>
                    <input name="price" type="number" id="example-password" class="form-control" value="password">
                  </div>

                  <div class="form-group mb-3">
                    <label for="example-palaceholder">الخصم</label>
                    <input name="discount" type="number" id="example-palaceholder" class="form-control">
                  </div>
                </div> <!-- /.col -->

                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label for="example-helping">الكمية</label>
                    <input name="quantity" type="number" id="example-helping" class="form-control" >
                  </div>

                  <div class="form-group mb-3">
                    <label for="colors">الالوان</label>
                    <select name="colors[]" id="colors" class="form-control select2" multiple="multiple">
                            <option value="الاحمر">الاحمر</option>
                            <option value="الازرق">الازرق</option>
                            <option value="الاحضر">الاحضر</option>
                            <option value="الاصفر">الاصفر</option>
                            <option value="الرمادي">الرمادي</option>
                            <option value="البرتقالي">البرتقالي</option>
                            <option value="الزيتوني">الزيتوني</option>
                    </select>
                </div>
            
                <div class="form-group mb-3">
                    <label for="sizes">الاحجام</label>
                    <select name="sizes[]" id="sizes" class="form-control select2" multiple="multiple">
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

                <div class="form-group mb-3">
                  <label for="example-textarea">الوصف</label>
                  <textarea name="desc" class="form-control" id="example-textarea" rows="4"></textarea>
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