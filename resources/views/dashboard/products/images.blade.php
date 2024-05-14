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





        <div class="card shadow mb-5">
            <div class="card-body">
              <!-- table -->
              <table class="table datatables" id="dataTable-1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الصور</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                            @php
                                $i = 0;
                            @endphp
                    @foreach ($images as $image)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td><img src="{{ asset($image->name) }}" alt="صورة منتج" style="width:100px;"></td> <!-- assuming the attribute for the image path is 'path', change accordingly -->
                            <td>
                                <!-- Example of a delete link, adjust the URL as necessary -->
                                <form action="{{ route('dashboard.products.images.delete', $image->id) }}" method="post">
                                    @csrf

                                    <input type="submit" value="حذف"  class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            </div>
          </div>




{{-- ============================================= --}}





        <form action="{{ route('dashboard.products.images.store', $id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="productImages">إضافة صور المنتج</label>
                        <div class="custom-file">
                            <input type="file" name="name[]" id="productImages" class="custom-file-input" multiple>
                            <label class="custom-file-label" for="productImages">اختار الصور</label>
                        </div>
                    </div>
                    <input type="submit" value="حفظ البيانات" class="btn btn-primary">
                </div>
            </div>
        </form>
      

    </div>
</main>
@endsection

@section('scripts')

@endsection