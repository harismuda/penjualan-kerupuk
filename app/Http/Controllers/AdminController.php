<?php

namespace App\Http\Controllers;

use App\Models\Kerupuk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $data = Transaksi::get();
        
        return view('admin.dashboar', compact('data'));
    }

    public function history($order = 'desc') {
        $kerupuk = Kerupuk::orderBy('kerupukID', $order)->get();
        return view('admin.activity', compact('kerupuk'));
    }

    public function kerupuk($order = 'asc') {
        $kerupuk = Kerupuk::orderBy('nama_barang', $order)->get();
        return view('admin.kerupuk', compact('kerupuk'));
    }

    public function store(Request $request) {

        $request->validate([
            'nama_barang' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        if ($request->hasFile('gambar_barang')) {
            $gambar = $request->file('gambar_barang')->store('photos', 'public');
            $imgName = 'img' . time() . '.' . $request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('gambar_barang'), $imgName);

            Kerupuk::insert([
                'nama_barang' => $request->nama_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->stok,
                'gambar_barang' => $imgName,
                'activity' => $request->activity,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->back()->with('success', 'Data barang berhasil ditambahkan.');
        } else {
            Kerupuk::insert([
                'nama_barang' => $request->nama_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->stok,
                'activity' => $request->activity,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->back()->with('success', 'Data barang berhasil ditambahkan.');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $kerupuk = Kerupuk::find($request->id);

        
        if($request->hasFile('gambar_barang')) {
            if ($request->hasFile('gambar_barang')) {
                
                $imgName = 'img' . time() . '.' . $request->gambar_barang->extension();
                $request->gambar_barang->move(public_path('gambar_barang'), $imgName);
                
                if($kerupuk->gambar_barang){
                    $oldImagePath = public_path('gambar_barang/') . $kerupuk->gambar_barang;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                $gambar = $kerupuk->gambar_barang;
            }
            $kerupuk->update([
                'nama_barang' => $request->nama_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->stok,
                'gambar_barang' => $imgName,
                'activity' => $request->activity,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    
            return redirect()->back()->with('success', 'Data barang berhasil diperbarui.');
        } else {
            $kerupuk->update([
                'nama_barang' => $request->nama_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->stok,
                'activity' => $request->activity,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->back()->with('success', 'Data barang berhasil diperbarui.');
        }
    }


    public function destroy($id)
    {
        $kerupuk = Kerupuk::find($id);

        if (!$kerupuk) {
            return redirect()->back()->with('error', 'Kerupuk not found.');
        }

        $imagePath = public_path('gambar_barang/' . $kerupuk->gambar_barang);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $kerupuk->delete();

        return redirect()->back()->with('success', 'Data barang berhasil dihapus.');
    }
}
