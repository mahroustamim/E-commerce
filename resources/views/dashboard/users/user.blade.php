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
          <form action="{{ route('dashboard.users') }}">
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
                <th>{{ __('words.money') }}</th>
                <th>{{ __('words.orders') }}</th>
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
                <td>{{ $user->orders_sum_total_price }} <span>&pound;</span></td>
                <td>{{ $user->orders_count }}</td>
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
  
  
@endsection

@section('scripts')
@endsection
