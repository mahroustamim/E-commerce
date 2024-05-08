@extends('dashboard.layouts.master')

@section('title')
    الاقسام
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('AdminAsset/css/dataTables.bootstrap4.css') }}">
<link href="https://unpkg.com/dropzone/dist/dropzone.css" rel="stylesheet">

</style>
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
        {{-- errors --}}
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif
{{-- ============================================================= --}}
      <!-- Button to trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#varyModal">
    إضافة قسم
</button>

<!-- add category -->
<div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">إضافة قسم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('dashboard.categories.store') }}" >
                    @csrf

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">الاسم:</label>
                        <input autocomplete="false" type="text" name="name" class="form-control" id="recipient-name">
                    </div>
                    <div class="custom-file mb-3">
                        <input name="image" type="file" class="custom-file-input" id="image" aria-describedby="emailHelp" onchange="previewImage(this, 'logoPreview')">
                        <label for="image" class="custom-file-label">اختر صورة</label>
                    </div>
                    <div class="form-group">
                        <img id="logoPreview" src="#" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mb-2" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary mb-2">حفظ البيانات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

      {{-- ====================================================== --}}
      {{-- ====================  delete   ==================== --}}
      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">حذف قسم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('dashboard.categories.delete') }}">
                        @csrf
    
                        <input type="hidden" id="id" name="id" value="">
    
                        <p class="s">هل أنت متأكد أنك تريد حذف هذا القسم؟</p>
    
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

      {{-- ====================  edit   ==================== --}}
      <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">تعديل القسم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('dashboard.categories.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
        
                        <input type="hidden" id="id" name="id">

                        <div class="form-group">
                            <label for="name" class="col-form-label">الاسم:</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>

                        <div class="custom-file mb-3">
                            <input name="image" type="file" class="custom-file-input" id="file" aria-describedby="fileHelp" onchange="previewImage(this, 'previewImage2')">
                            <label for="file" class="custom-file-label">اختر صورة</label>
                        </div>

                        <div class="form-group">
                            <img id="previewImage2" src="" alt="مراجعة الصورة" style="max-width: 100%; height: auto; display: none;">
                        </div> 
                        
                        <div class="form-group">
                            <img id="image" src="" alt="Image" style="max-width: 100%; height: auto; display: none;">
                        </div>                        
        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mb-2" data-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-success mb-2">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    

      {{-- ====================================================== --}}


      <div class="card shadow">
        <div class="card-body">
            <table class="table datatables" id="mahrous">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>إسم القسم</th>
                    <th>صورة القسم</th>
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
<script src="https://unpkg.com/dropzone/dist/dropzone.min.js"></script>


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
            ajax: "{{ route('dashboard.categories.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name', name: 'name'}, 
                {data: 'image', name: 'image'}, 
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            autoWidth: true,
            lengthMenu: [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    });
    // ==============================================
    // =================== image ====================
    function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            var previewElement = document.getElementById(previewId);
            previewElement.src = e.target.result;
            previewElement.style.display = 'block'; // Make the image visible
        }
        
        reader.readAsDataURL(input.files[0]); // Convert the file to a data URL and load it
    }
}

//==============================================
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
//==================  edit  ====================

$(document).ready(function () {
    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var name = button.data('name');
        var image = button.data('image');

        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #image').attr('src', image).show();
    });
});

//======================================








</script>
@endsection