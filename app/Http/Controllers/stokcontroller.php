<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    // Fungsi untuk menampilkan form edit stok
    public function edit($id)
    {
        // Cari stok berdasarkan ID
        $stok = Stok::find($id);

        if (!$stok) {
            return redirect()->back()->with('error', 'Stok tidak ditemukan');
        }

        // Return view dengan data stok
        return view('stok.edit', compact('stok'));
    }

    // Fungsi untuk update stok melalui form
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'penambahan_stok' => 'nullable|integer|min:0',
            'pengurangan_stok' => 'nullable|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        // Cari data stok berdasarkan ID
        $stok = Stok::find($id);

        if (!$stok) {
            return redirect()->back()->with('error', 'Stok tidak ditemukan');
        }

        // Update jumlah stok
        $penambahanStok = $request->input('penambahan_stok', 0);
        $penguranganStok = $request->input('pengurangan_stok', 0);
        $stok->jumlah_stok = $stok->jumlah_stok + $penambahanStok - $penguranganStok;

        // Simpan penambahan/pengurangan dan keterangan
        $stok->penambahan_stok = $penambahanStok;
        $stok->pengurangan_stok = $penguranganStok;
        $stok->keterangan = $request->input('keterangan', '');

        // Simpan ke database
        $stok->save();

        return redirect()->back()->with('success', 'Stok berhasil diupdate');
    }
}
