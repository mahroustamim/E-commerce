@extends('dashboard.layout.master')

@section('title')
    {{ __('words.categories') }}
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


    {{-- create category button --}}
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary mb-5 mt-3">{{ __('words.add') }}  {{ __('words.category') }}</a>

{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('dashboard.categories.delete') }}" method="post">
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


    {{-- table --}}
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="mahrous">
                <thead>
                    <tr>
                        <th class="text-left">#</th>
                        <th class="text-left">{{ __('words.name') }}</th>
                        <th class="text-left">{{ __('words.image') }}</th>
                        <th class="text-left">{{ __('words.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>
</div>


    


@endsection

@section('scripts')

<script src="{{ asset('adminAsset/plugins/DataTables/datatables.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#mahrous').DataTable({
            language: {
                paginate: {
                    previous: '{{ __('words.next') }}',
                    next: '{{ __('words.previous') }}',
                },
                processing: '{{ __('words.load') }} ...',
                lengthMenu: '_MENU_ {{ __('words.allEntries') }} ',
                search: '{{ __('words.search') }}',
                emptyTable: '{{ __('words.emptyTable') }}',
            },
            info: false,
            processing: true,
            serverSide: true,
            scrollX: true ,
            ajax: "{{ route('dashboard.categories.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name', name: 'name'}, 
                {data: 'image', name: 'image'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
    });
</script>

<script>
    $(document).ready(function () {
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes

        var modal = $(this);
        modal.find('.modal-body #id').val(id);
    });
});
</script>
@endsection
