@extends('dashboard.layout.master')

@section('title')
    {{ __('words.products') }}
@endsection

@section('styles')    
<link rel="stylesheet" href="{{ asset('adminAsset/plugins/DataTables/datatables.min.css') }}">

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

    @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
    @endif

{{-- ============================================ delete modal ================================= --}}
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('dashboard.products.delete') }}" method="post">
          @csrf
          <div class="modal-body">
              <input type="hidden" id="id" name="id" value="">
  
              <p class="h4">{{ __('words.areYouSure') }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('words.close') }}</button>
            <input type="submit" value="{{ __('words.delete') }}" class="btn btn-danger">
          </div>
      </form>
      
    </div>
  </div>
</div>
{{-- ================================== End delete modal ===================================== --}}


    {{-- status --}}
    {{-- =================================== status modal ========================================= --}}
<div class="modal fade" id="status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('dashboard.products.status') }}" method="post">
          @csrf
          <div class="modal-body">
              <input type="hidden" id="id" name="id" value="">
              <select name="status" id="status" class="custom-select">
                <option value="" disabled selected>-- {{ __('words.select') }} --</option>
                <option value="available">{{ __('words.available') }}</option>
                <option value="unavailable">{{ __('words.unavailable') }}</option>
              </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('words.close') }}</button>
            <input type="submit" value="{{ __('words.save') }}" class="btn btn-primary">
          </div>
      </form>
      
    </div>
  </div>
</div>
    {{-- =================================== End status modal========================================= --}}


    <div class="row justify-content-center">
        <div class="col-12">
          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <!-- table -->
                  <table class="table datatables" id="mahrous">
                    <thead>
                      <tr>
                        <th class="text-left">#</th>
                        <th class="text-left">{{ __('words.name') }}</th>
                        <th class="text-left">{{ __('words.category') }}</th>
                        <th class="text-left">{{ __('words.photo') }}</th>
                        <th class="text-left">{{ __('words.price') }}</th>
                        <th class="text-left">{{ __('words.discount') }}</th>
                        <th class="text-left">{{ __('words.quantity') }}</th>
                        <th class="text-left">{{ __('words.creator') }}</th>
                        <th class="text-left">{{ __('words.status') }}</th>
                        <th class="text-left">{{ __('words.action') }}</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div> <!-- simple table -->
          </div> <!-- end section -->
        </div> <!-- .col-12 -->
      </div> <!-- .row -->




@endsection

@section('scripts')
<script src="{{ asset('adminAsset/plugins/DataTables/datatables.min.js') }}"></script>

<script>
    $(document).ready(function() {
    $('#mahrous').DataTable({
        language: {
            paginate: {
                previous: '{{ __('words.previous') }}',  
                next: '{{ __('words.next') }}',
            },
            processing: '{{ __('words.load') }} ...',
            lengthMenu: '_MENU_ {{ __('words.allEntries') }} ',
            search: '{{ __('words.search') }}',
            emptyTable: '{{ __('words.emptyTable') }}',
        },
        info: false,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.products.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            @if(app()->getLocale() == 'en')
                {data: 'name_en', name: 'name_en'},
            @else
                {data: 'name_ar', name: 'name_ar'},
            @endif
            {data: 'category_name', name: 'category_name'},
            {data: 'photo', name: 'photo'},
            {data: 'price', name: 'price'},
            {data: 'discount', name: 'discount'},
            {data: 'quantity', name: 'quantity'},
            {data: 'creator', name: 'creator'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        autoWidth: true,
        "lengthMenu": [
          [16, 32, 64, -1],
          [16, 32, 64, "All"]
        ]
    });
});

</script>
{{-- status --}}
<script>
  $(document).ready(function () {
  $('#status').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Extract info from data-* attributes

      var modal = $(this);
      modal.find('.modal-body #id').val(id);
  });
});
</script>
{{-- delete --}}
<script>
  $(document).ready(function () {
  $('#delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Extract info from data-* attributes

      var modal = $(this);
      modal.find('.modal-body #id').val(id);
  });
});
</script>
@endsection
