<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
                        <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#kerupukModal">
                            <iconify-icon icon="material-symbols:add-ad-sharp"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
            @if (Session::has('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ Session::get('success') }}',
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script>
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
                                <td><img src="{{ asset('gambar_barang/' . $item->gambar_barang) }}"
                                        alt="{{ $item->nama_barang }}" width="70px"></td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>Rp. @currency($item->harga_beli)</td>
                                <td>Rp. @currency($item->harga_jual)</td>
                                <td>@currency($item->stok)</td>
                                <td>
                                    <button class="btn btn-warning btn-edit" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-id="{{ $item->kerupukID }}"
                                        data-nama="{{ $item->nama_barang }}" data-harga-beli="{{ $item->harga_beli }}"
                                        data-harga-jual="{{ $item->harga_jual }}" data-stok="{{ $item->stok }}"
                                        data-gambar="{{ $item->gambar_barang }}">
                                        <iconify-icon icon="mingcute:edit-4-line"></iconify-icon>
                                    </button>

                                    <a href="{{ url('/kerupuk/delete/' . $item->kerupukID) }}" class="btn btn-danger"
                                        onclick="return confirm('Apa kamu yakin ingin mengahapus {{ $item->nama_barang }}?')">
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var hargaBeli = $(this).data('harga-beli');
            var hargaJual = $(this).data('harga-jual');
            var stok = $(this).data('stok');
            var gambar = $(this).data('gambar');

            console.log(id, nama, hargaBeli, hargaJual, stok, gambar);

            $('#edit-stok').on('input', function() {
                var stokValue = $(this).val();

                // Ensure stok is between 0 and maxstok (stock)
                stokValue = parseInt(stokValue);

                if (isNaN(stokValue) || stokValue < 0) {
                    stokValue = 0;
                }

                $(this).val(stokValue);
                console.log('stokValue:', stokValue);
            });

            stok = Math.max(stok, 0);

            $('#edit-id').val(id);
            $('#edit-nama-barang').val(nama);
            $('#edit-harga-beli').val(hargaBeli);
            $('#edit-harga-jual').val(hargaJual);
            $('#edit-stok').val(stok);

            $('#edit-gambar-preview').attr('src', '{{ asset('gambar_barang/') }}' + '/' + gambar);

            if (gambar !== '') {
                $('#edit-gambar-container').hide();
                $('#edit-gambar-ada').show();
                $('#edit-gambar-update').show();
            } else {
                $('#edit-gambar-container').show();
                $('#edit-gambar-ada').hide();
                $('#edit-gambar-update').hide();
            }

            $(document).on('click', '.edit-gambar-update', function(event) {
                event.preventDefault();

                $('#edit-gambar-container').show();
                $('#edit-gambar-ada').hide();
                $('#edit-gambar-update').hide(); 
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-add', function() {

            $('#stok').on('input', function() {
                var stokValue = $(this).val();

                stokValue = parseInt(stokValue);

                if (isNaN(stokValue) || stokValue < 0) {
                    stokValue = 0;
                }

                $(this).val(stokValue);
                console.log('stokValue:', stokValue);
            });

            stok = Math.max(stok, 0);
        });
    });
</script>

{{-- Modal Add Kerupuk --}}
<div class="modal fade" id="kerupukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/store_kerupuk') }}" method="post" enctype="multipart/form-data">
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
                            <input type="number" class="form-control" aria-describedby="basic-addon1" name="harga_beli"
                                required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga beli" class="col-form-label">Harga Jual:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="number" class="form-control" aria-describedby="basic-addon1" name="harga_jual"
                                required>
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

{{-- Modal Edit Kerupuk  --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/update_kerupuk') }}" id="edit-form" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label for="edit-nama-barang" class="col-form-label">Nama Barang:</label>
                        <input type="text" class="form-control" id="edit-nama-barang" name="nama_barang"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-harga-beli" class="col-form-label">Harga Beli:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="number" class="form-control" aria-describedby="basic-addon1"
                                id="edit-harga-beli" name="harga_beli" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-harga-jual" class="col-form-label">Harga Jual:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="number" class="form-control" aria-describedby="basic-addon1"
                                id="edit-harga-jual" name="harga_jual" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-stok" class="col-form-label">Stok:</label>
                        <input type="number" class="form-control" id="edit-stok" name="stok" required>
                    </div>

                    <div class="mb-3" id="edit-gambar-update">
                        <button class="btn btn-primary edit-gambar-update">Ubah Gambar</button>
                    </div>

                    <div class="mb-3" id="edit-gambar-container">
                        <label for="edit-gambar" class="col-form-label">Gambar Barang:</label>
                        <input class="form-control" type="file" id="edit-gambar" name="gambar_barang">
                    </div>

                    <div class="mb-3" id="edit-gambar-ada">
                        <label for="edit-gambar" class="col-form-label">Gambar Barang:</label>
                        <img id="edit-gambar-preview" width="100%">
                    </div>
                </div>
                <input type="hidden" value="Update Master Barang" name="activity">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
