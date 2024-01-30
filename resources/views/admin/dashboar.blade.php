@extends('layout.master')

@section('konten')
    {{-- <div class="row m-1">
        <div class="card col-md-12 m-1">
            <div class="card-header text-center bg-light">
                <p>Search Range Grafik</p>
            </div>
            <div class="card-body">
                <form action="{{ url('/get-transaksi') }}" method="get">
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="dateFilter" name="date" style="border-radius:20px;">
                        <button class="btn btn-primary" type="submit" style="border-radius:20px; margin-right:5px; margin-left:5px;">Search by Grafik Range</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="row m-1">
        <div class="card col-md-7 m-1">
            <div class="card-header text-center bg-light">
                <p>Penjualan</p>
            </div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="card col-md-4 m-1" style="width: 39%">
            <div class="card-header text-center bg-light">
                Day Profit
            </div>
            <div class="card-body">
                <canvas id="myPieChart"></canvas>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('desain') }}/js/bar.js"></script>
<script src="{{ asset('desain') }}/js/pie.js"></script>
