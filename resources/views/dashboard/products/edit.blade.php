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