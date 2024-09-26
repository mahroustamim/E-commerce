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
      <p class="mb-3">{{ __('words.count') . ': ' . $orders->count() }}</p>
      <div class="card shadow">
        <div class="card-body">
          <form action="{{ route('dashboard.orders.pending') }}">
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
                <th>{{ __('words.order_number') }}</th>
                <th>{{ __('words.name') }}</th>
                <th>{{ __('words.governorate') }}</th>
                <th>{{ __('words.phone') }}</th>
                <th>{{ __('words.total') }}</th>
                <th>{{ __('words.payment_status') }}</th>
                <th>{{ __('words.payment') }}</th>
                <th>{{ __('words.status') }}</th>
                <th>{{ __('words.action') }}</th>
              </tr>
            </thead>

            <tbody>

              @foreach ($orders as $order)
              <tr class="accordion-toggle collapsed" id="c-2474" data-toggle="collapse" data-parent="#c-2474" href="#collap-2474">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->number }}</td>
                <td>{{ $order->address->name }}</td>
                <td>{{ $order->address->governorate->{'governorate_' . app()->getLocale()} }}</td>
                <td>{{ $order->address->phone }}</td>
                <td>{{ $order->total_price }} <span>&pound;</span></td>
                <td>{{ __('words.' . $order->payment_status) }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ __('words.' . $order->status) }}</td>
                <td>
                  <form action="{{ route('dashboard.orders.status', $order->id) }}" method="POST">
                    @csrf
                    <input name="status" type="hidden" value="delivering">
                    <input type="submit" value="{{ __('words.delivering') }}" class="btn btn-outline-success ">
                  </form>
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
        {!! $orders->links() !!}
    </div>
  
  
@endsection

@section('scripts')
@endsection
