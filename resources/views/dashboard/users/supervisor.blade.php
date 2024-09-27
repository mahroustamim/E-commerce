@extends('dashboard.layout.master')

@section('title')
@endsection

@section('styles')  
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
    @if (session('error'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{ session('error') }}",
                    type: "error"
                });
            }
        </script>
    @endif

  <div class="row">
    <div class="col-md-12 my-4">
      <p class="mb-3">{{ __('words.count') . ': ' . $users->count() }}</p>
      <div class="card shadow">
        <div class="card-body">
          <form action="{{ route('dashboard.supervisors') }}">
            <div class="input-group col-6 mb-3">
              <input type="text" class="form-control" value="{{ isset($search) ? $search : '' }}" name="search" aria-label="Default" aria-describedby="inputGroup-sizing-default">
              <div class="input-group-prepend">
                <input type="submit" value="{{ __('words.search') }}" class="btn btn-success text-white">
              </div>
            </div>
          </form>

        
          <!-- table -->
          <table class="table table-hover table-borderless border-v">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>{{ __('words.name') }}</th>
                <th>{{ __('words.email') }}</th>
                <th>{{ __('words.governorate') }}</th>
                <th>{{ __('words.phone') }}</th>
                <th>{{ __('words.action') }}</th>
              </tr>
            </thead>

            <tbody>

              @foreach ($users as $user)
              <tr class="accordion-toggle collapsed" id="c-2474" data-toggle="collapse" data-parent="#c-2474" href="#collap-2474">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->governorate->{'governorate_' . app()->getLocale()} }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    <a href="{{ route('dashboard.supervisors.edit', $user->id) }}" class="btn btn-success text-light">{{ __('words.edit') }}</a>
                    <a href="#exampleModal" data-toggle="modal" data-id="{{ $user->id }}" class="btn btn-danger">{{ __('words.delete') }}</a>

                </td>
              </tr>
              @endforeach


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> <!-- end section -->

      <!-- Render pagination links -->
      <div class="d-flex justify-content-center">
        {!! $users->links() !!}
    </div>



    {{-- ============================== delete model =========================================== --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('dashboard.supervisors.delete') }}" method="post">
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
  
  
@endsection

@section('scripts')
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
