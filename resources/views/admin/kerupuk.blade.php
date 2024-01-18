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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kerupukModal">
                        <iconify-icon icon="material-symbols:add-ad-sharp"></iconify-icon>
                    </button>
                </div>
            </div>
        </div>
        @if (Session::has('success'))
                <div class="pt-3">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
        <div class="card-body">
            <table id="example" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kerupuk as $item)
                    <tr>
                        <td><img src="{{ asset('gambar_barang/' . $item->gambar_barang) }}" alt="{{ $item->nama_barang }}" width="70px"></td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>Rp. @currency($item->harga_beli)</td>
                        <td>Rp. @currency($item->harga_jual)</td>
                        <td>@currency($item->stok)</td>
                        <td>
                            <a href="#" class="btn btn-warning">
                                <iconify-icon icon="mingcute:edit-4-line"></iconify-icon>
                            </a>
                            <a href="{{url('/kerupuk/delete/'. $item->kerupukID)}}" class="btn btn-danger" onclick="return confirm('Apa kamu yakin ingin mengahapus {{ $item->nama_barang }}?')">
                                <iconify-icon icon="bi:trash-fill"></iconify-icon>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- Modal Add Kerupuk --}}
<div class="modal fade" id="kerupukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="{{url('/store_kerupuk')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama barang" class="col-form-label">Nama Barang:</label>
                    <input type="text" class="form-control" id="nama-barang" name="nama_barang" required>
                </div>
                <div class="mb-3">
                    <label for="harga jual" class="col-form-label">Harga Beli:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp. </span>
                        <input type="number" class="form-control" aria-describedby="basic-addon1" name="harga_beli" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="harga beli" class="col-form-label">Harga Jual:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp. </span>
                        <input type="number" class="form-control" aria-describedby="basic-addon1" name="harga_jual" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="stok" class="col-form-label">Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok" required>
                </div>
                <div class="mb-3">
                    <label for="gambar barang" class="col-form-label">Gambar Barang:</label>
                    <input class="form-control" type="file" id="formFile" name="gambar_barang">
                </div>
            </div>
            <input type="hidden" value="Add Master Barang" name="activity">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
  </div>
</div>