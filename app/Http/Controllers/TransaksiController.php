<?php

namespace App\Http\Controllers;

use App\Models\Kerupuk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function transaksi() {
        $kerupuk = Kerupuk::get();
        $transaksi = Transaksi::select('*')
        ->join('kerupuk', 'kerupuk.kerupukID', '=', 'transaksi.kerupukID')
        ->get();
        return view('admin.transaksi', compact('transaksi','kerupuk'));
    }

    public function store_transaksi(Request $request){
        $request->validate([
            'qty' => ['required', 'numeric', 'min:0'],
        ]);

        Transaksi::insert([
            'kerupukID' => $request->kerupukID,
            'qty' => $request->qty,
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
            'qty' => $request->qty,
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
        $data = Transaksi::select('transaksi.created_at', 'transaksi.qty', 'kerupuk.harga_jual')
        ->join('kerupuk', 'kerupuk.kerupukID', '=', 'transaksi.kerupukID')
        ->get();
        return response()->json($data);
    }
}
