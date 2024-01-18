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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transaksiModal">
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
                            <th>Nama Barang</th>
                            <th>QTY</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                            <tr>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Rp. @currency($item->qty * $item->harga_jual)</td>
                                <td>
                                    <button class="btn btn-warning btn-edit" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-id="{{ $item->transaksiID }}"
                                        data-kerupukID="{{ $item->kerupukID }}" data-qty="{{ $item->qty }}">
                                        <iconify-icon icon="mingcute:edit-4-line"></iconify-icon>
                                    </button>

                                    <a href="{{ url('/kerupuk/delete/' . $item->transaksiID) }}" class="btn btn-danger"
                                        onclick="return confirm('Apa kamu yakin ingin mengahapusnya?')">
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
            var kerupukID = $(this).data('kerupukID');
            var qty = $(this).data('qty');

            console.log(id, kerupukID, qty);

            $('#edit-id').val(id);
            $('#edit-kerupukID').val(kerupukID);
            $('#edit-qty').val(qty);
        });
    });
</script>

<div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/store_transaksi') }}" method="post" id="transaction">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="dropdown-form">
                            <select name="kerupukID" id="kerupukSelect" class="form-control">
                                <option>Pilih Barang</option>
                                @foreach ($kerupuk as $item)
                                    <option value="{{ $item->kerupukID }}" data-harga="{{ $item->harga_jual }}">{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga jual" class="col-form-label">Harga Jual</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="number" class="form-control" aria-describedby="basic-addon1" id="harga_jual" name="harga_jual" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="col-form-label">QTY</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="qty" id="qty" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="subtotal" class="col-form-label">Subtotal</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="number" class="form-control" aria-describedby="basic-addon1" id="subtotal" name="subtotal" readonly>
                        </div>
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
<script>
    $(document).ready(function() {
        $('#kerupukSelect').change(function() {
            var selectedOption = $(this).find(':selected');
            var harga = selectedOption.data('harga');

            console.log('Harga:', harga);
            $('#harga_jual').val(harga);

            updateSubtotal();
        });

        $('#qty').on('input', function() {
            console.log('Qty:', $('#qty').val());
            updateSubtotal();
        });

        function updateSubtotal() {
            var harga = parseFloat($('#harga_jual').val()) || 0;
            var qty = parseInt($('#qty').val()) || 0;

            var subtotal = harga * qty;
            console.log('Subtotal:', subtotal);

            $('#subtotal').val(subtotal);
        }
    });
</script>
