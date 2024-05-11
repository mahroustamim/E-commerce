@extends('dashboard.layouts.master')

@section('title')
    المنتجات
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('AdminAsset/css/dataTables.bootstrap4.css') }}">

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

        {{-- ====================  delete   ==================== --}}
      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">حذف منتج</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('dashboard.products.delete') }}">
                        @csrf
    
                        <input type="hidden" id="id" name="id" value="">
    
                        <p class="s">هل أنت متأكد أنك تريد حذف هذا المنتج</p>
    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mb-2" data-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-danger mb-2">حذف</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

      {{-- ====================================================== --}}
      {{-- ====================================================== --}}


      <div class="card shadow">
        <div class="card-body">
            <table class="table datatables" id="mahrous">
                <thead>
                  <tr>
                    <th>#</th>
                        <th>الاسم</th>
                        <th>القسم</th>
                        <th>السعر</th>
                        <th>الخصم</th>
                        <th>الكمية</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                  </tr>
                </thead>
                <tbody>
                
                </tbody>
              </table>
        
        </div>
    </div>

       
  </div>     
</main>
@endsection

@section('scripts')
<script src='{{ asset('AdminAsset/js/jquery.dataTables.min.js') }}'></script>
<script src='{{ asset('AdminAsset/js/dataTables.bootstrap4.min.js') }}'></script>

<script>
    $(document).ready(function() {
        $('#mahrous').DataTable({
            language: {
                paginate: {
                    previous: 'السابق',
                    next: 'التالي',
                },
                processing: '...تحميل',
                lengthMenu: '_MENU_ كل المدخلات',
                search: 'ابحث',
                emptyTable: 'لا توجد بيانات متاحة في الجدول',
            },
            info: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('dashboard.products.index') }}",
                type: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name', name: 'name'}, 
                {data: 'category_name', name: 'category_name'}, 
                {data: 'price', name: 'price'}, 
                {data: 'discount', name: 'discount'}, 
                {data: 'quantity', name: 'quantity'}, 
                {data: 'status', name: 'status'}, 
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            autoWidth: true,
            lengthMenu: [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    });

    //==================  delete ===================

$(document).ready(function () {
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes

        var modal = $(this);
        modal.find('.modal-body #id').val(id);
    });
});

//==============================================
</script>
@endsection