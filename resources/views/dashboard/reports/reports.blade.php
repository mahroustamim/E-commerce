@extends('dashboard.layout.master')

@section('title')
@endsection

@section('styles')    
@endsection

@section('content')
    <!-- info small box -->
<div class="row">
    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <span class="h2 mb-0">{{ $pending }}</span>
              <p class="small text-muted mb-0">{{ __('words.pending') }}</p>
              {{-- <span class="badge badge-pill badge-success">+15.5%</span> --}}
            </div>
            <div class="col-auto">
              <span class="fe fe-32 fe-shopping-cart  text-muted mb-0"></span>
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
              <span class="h2 mb-0">{{ $delivering }}</span>
              <p class="small text-muted mb-0">{{ __('words.delivering') }}</p>
              {{-- <span class="badge badge-pill badge-success">+16.5%</span> --}}
            </div>
            <div class="col-auto">
              <span class="fe fe-32 fe-shopping-cart text-muted mb-0"></span>
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
              <span class="h2 mb-0">{{ $completed }}</span>
              <p class="small text-muted mb-0">{{ __('words.completed') }}</p>
              {{-- <span class="badge badge-pill badge-warning">+1.5%</span> --}}
            </div>
            <div class="col-auto">
              <span class="fe fe-32 fe-shopping-cart text-muted mb-0"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- end section -->



  <div class="row">
    <div class="col mb-4">
      <div class="card shadow">
        <div class="card-header">
          <strong class="card-title mb-0">{{ __('words.orders') }}</strong>
        <div class="card-body">
          <canvas id="barChart" width="400" height="100"></canvas>
        </div>
      </div>
    </div>
</div>




@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['{{ __('words.pending') }}', '{{ __('words.delivering') }}', '{{ __('words.completed') }}'],
                datasets: [{
                    label: '{{ __('words.orders') }}',
                    data: [{{ $pending }}, {{ $delivering }}, {{ $completed }}], // Data passed from the controller
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', // Pending color
                        'rgba(54, 162, 235, 0.2)', // Delivering color
                        'rgba(153, 102, 255, 0.2)',  // Completed color
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
