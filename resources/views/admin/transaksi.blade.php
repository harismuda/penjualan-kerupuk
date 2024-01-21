<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

@extends('layout.master')
@section('konten')
    <div class="row m-1">
        <div class="card col-md-12 mt-1">
            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-6 text-start">
                        <h4>Table Transaksi</h4>
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
                <table id="example" class="table table-bordered table-striped text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>QTY</th>
                            <th>Subtotal</th>
                            <th></th>
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
                                        data-bs-target="#TransaksiEditModal" data-id="{{ $item->transaksiID }}"
                                        data-kerupuk="{{ $item->kerupukID }}" data-qty="{{ $item->qty }}"
                                        data-barang="{{ $item->nama_barang }}" data-harga="{{ $item->harga_jual }}">
                                        <iconify-icon icon="mingcute:edit-4-line"></iconify-icon>
                                    </button>
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
            var kerupuk = $(this).data('kerupuk');
            var qty = $(this).data('qty');
            var barang = $(this).data('barang');
            var harga = $(this).data('harga');

            console.log(id, kerupuk, qty, barang, harga);

            var subtotal = harga * qty;

            $('#edit-id').val(id);
            $('.edit-qty').val(qty);
            $('.edit-namaBarang').val(barang);
            $('#edit-harga').val(harga);
            $('#edit-subtotal').val(subtotal);

            $('#edit-kerupukID.edit-namaBarang').text(barang).val(kerupuk);

            console.log('ID Transaksi : ', $('#edit-id').val())
            console.log('ID Kerupuk : ', $('#edit-kerupukID').val())
            console.log('QTY : ', $('.edit-qty').val())
            console.log('Nama Kerupuk : ', $('.edit-namaBarang').val())

            $('.edit-qty').on('input', function() {
            updateSubtotal();
            // updateStok();
            });

            function updateSubtotal() {
                var newQty = parseInt($('.edit-qty').val()) || 0;
                var newSubtotal = harga * newQty;
                console.log('New Subtotal:', newSubtotal);
                $('#edit-subtotal').val(newSubtotal);
            }

            // function updateStok() {
            //     var newQty = parseInt($('.edit-qty').val()) || 0;
            //     var newStok = newQty - qty;
            //     console.log('QTY selisih = ', newStok)
            // }
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
                                    <option value="{{ $item->kerupukID }}" data-harga="{{ $item->harga_jual }}">
                                        {{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga jual" class="col-form-label">Harga Jual</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="number" class="form-control" aria-describedby="basic-addon1" id="harga_jual"
                                name="harga_jual" readonly>
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
                            <input type="number" class="form-control" aria-describedby="basic-addon1" id="subtotal"
                                name="subtotal" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="transaksiEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/update_transaksi') }}" method="post" id="transaction">
                @csrf @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <div class="dropdown-form">
                            <select name="kerupukID" id="kerupukSelect" class="form-control" readonly>
                                <option id="edit-kerupukID" class="edit-namaBarang" value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga jual" class="col-form-label">Harga Jual</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="number" class="form-control" aria-describedby="basic-addon1" id="edit-harga" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="col-form-label">QTY</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control edit-qty" name="qty" id="qty" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="subtotal" class="col-form-label">Subtotal</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="number" class="form-control" aria-describedby="basic-addon1" id="edit-subtotal" readonly>
                        </div>
                    </div>
                </div>
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

<script>
$(document).ready(function() {
    var table = $('#example').DataTable({
        lengthChange: false,
        buttons: [{
            extend: 'excel',
            text: 'Excel',
            customizeData: function (excelData) {
                for (var i = 0; i < excelData.body.length; i++) {
                    excelData.body[i][2] = excelData.body[i][2].replace('Rp. ', '');
                    excelData.body[i][2] = excelData.body[i][2].replace('.',''); //Ribuan
                    excelData.body[i][2] = excelData.body[i][2].replace('.',''); //Jutaan
                    excelData.body[i][2] = excelData.body[i][2].replace('.',''); //Miliaran
                }

                console.log('Modified Excel Data:', excelData);
            }
        }, 'pdf', 'colvis']
    });

    table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
});

</script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
