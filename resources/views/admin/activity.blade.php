@extends('layout.master')
@section('konten')
<div class="row m-1">
    <div class="card col-md-12 mt-1">
        <div class="card-header bg-light">
            <h4>Table List Kerupuk</h4>
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>Activity</th>
                        <th>Item</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kerupuk as $item)
                    <tr>
                        <td>{{ $item->activity }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        @if ($item->activity == 'Add Master Barang')
                            <td>{{ $item->created_at }}</td>
                        @else
                            <td>{{ $item->updated_at }}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection