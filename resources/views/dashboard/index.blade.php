@extends('dashboard.layout.master')

@section('title')
    {{ __('words.dashboard') }}
@endsection

@section('content')
<div class="row">
  <div class="col-md-6 col-xl-3 mb-4">
    <div class="card shadow bg-primary text-white">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-3 text-center">
            <span class="circle circle-sm bg-primary-light">
              <i class="fe fe-16 fe-shopping-bag text-white mb-0"></i>
            </span>
          </div>
          <div class="col pr-0">
            <p class="small text-light mb-0">{{ __('words.total_sales') }}</p>
            <span class="h3 mb-0 text-white">{{ $sales }} &pound;</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-3 mb-4">
    <div class="card shadow">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-3 text-center">
            <span class="circle circle-sm bg-primary">
              <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
            </span>
          </div>
          <div class="col pr-0">
            <p class="small text-muted mb-0">{{ __('words.orders') }}</p>
            <span class="h3 mb-0">{{ $orders_count }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-3 mb-4">
    <div class="card shadow">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-3 text-center">
            <span class="circle circle-sm bg-primary">
              <i class="fe fe-inbox text-white mb-0"></i>
            </span>
          </div>
          <div class="col">
            <p class="small text-muted mb-0">{{ __('words.total_products') }}</p>
            <span class="h3 mb-0">{{ $products_count }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-3 mb-4">
    <div class="card shadow">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-3 text-center">
            <span class="circle circle-sm bg-primary">
              <i class="fe fe-16 fe-activity text-white mb-0"></i>
            </span>
          </div>
          <div class="col">
            <p class="small text-muted mb-0">{{ __('words.avg_orders') }}</p>
            <span class="h3 mb-0">{{ $orders_avg }} &pound;</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- end section -->

<!-- info small box -->
<div class="row">
  <div class="col-md-4 mb-4">
    <div class="card shadow">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col">
            <span class="h2 mb-0">{{ $categories_count }}</span>
            <p class="small text-muted mb-0">{{ __('words.categories') }}</p>
            {{-- <span class="badge badge-pill badge-success">+15.5%</span> --}}
          </div>
          <div class="col-auto">
            <span class="fe fe-32 fe-shopping-bag text-muted mb-0"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-4">
    <div class="card shadow">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col">
            <span class="h2 mb-0">{{ $supervisors }}</span>
            <p class="small text-muted mb-0">{{ __('words.supervisors') }}</p>
            {{-- <span class="badge badge-pill badge-success">+16.5%</span> --}}
          </div>
          <div class="col-auto">
            <span class="fe fe-32 fe-user-check text-muted mb-0"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-4">
    <div class="card shadow">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col">
            <span class="h2 mb-0">{{ $users }}</span>
            <p class="small text-muted mb-0">{{ __('words.users') }}</p>
            {{-- <span class="badge badge-pill badge-warning">+1.5%</span> --}}
          </div>
          <div class="col-auto">
            <span class="fe fe-32 fe-users text-muted mb-0"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- end section -->


<h3 class="mt-5">{{ __('words.latest_orders') }}</h3>

<!-- table -->
<table class="table table-hover table-borderless border-v mt-3 bg-white shadow-lg">
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
    </tr>
    @endforeach


  </tbody>
</table>
@endsection