<?php

namespace App\Http\Controllers;

use App\Models\Kerupuk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function transaksi(Request $request)
    {
        $kerupuk = Kerupuk::get();

        $currentDate = Carbon::now()->toDateString();

        $selectedDate = $request->input('date', $currentDate);

        $transaksi = Transaksi::select('*')
            ->whereDate('transaksi.created_at', $selectedDate)
            ->get();

        return view('admin.transaksi', compact('transaksi', 'kerupuk', 'selectedDate'));
    }


    public function store_transaksi(Request $request){
        $request->validate([
            'qty' => ['required', 'numeric', 'min:0'],
        ]);

        Transaksi::insert([
            'kerupukID' => $request->kerupukID,
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'subtotal' => $request->subtotal,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $kerupuk = Kerupuk::find($request->kerupukID);

        if ($kerupuk) {
            $kerupuk->stok -= $request->qty;
            $kerupuk->save();
        }

        return redirect()->back()->with('success', 'Data transaksi berhasil ditambahkan.');
    }

    public function update_transaksi(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric',
        ]);

        $transaksi = Transaksi::find($request->id);

        $oldQty = $transaksi->qty;

        $transaksi->update([
            'kerupukID' => $request->kerupukID,
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'subtotal' => $request->subtotal,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $kerupuk = Kerupuk::find($request->kerupukID);

        if ($kerupuk) {
            $newStok = $request->qty - $oldQty;
            $kerupuk->stok -= $newStok;
            $kerupuk->save();

            echo $newStok;
        }

        return redirect()->back()->with('success', 'Data transaksi berhasil diperbarui.');
    }
    public function get_transaksi()
    {
        $data = Transaksi::get();
        return response()->json($data);
    }
}
