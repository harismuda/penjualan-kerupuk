@extends('layout.master')
@section('konten')
<div class="row m-1">
    <div class="card col-md-12 mt-1">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-6 text-start">
                    <h4>Table List Kerupuk</h4>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="btn btn-primary">
                        Add
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-responsive table-striped text-center">
                <tr>
                    <th></th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
                <tr>
                    <td><img src="https://i1.wp.com/deweezz.com/wp-content/uploads/2017/08/kerupuk.png" alt="Kerupuk1" width="70px"></td>
                    <td>Kerupuk Palembang</td>
                    <td>Rp. 2.000,-</td>
                    <td>Rp. 3.000,-</td>
                    <td>5</td>
                    <td>
                        <a href="#" class="btn btn-warning">
                            Edit
                        </a>
                        <a href="#" class="btn btn-danger">
                            Delete
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection