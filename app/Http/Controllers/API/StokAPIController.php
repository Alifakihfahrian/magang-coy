<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StokAPIController extends Controller
{
    /**
     * Menampilkan daftar semua stok.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $stocks = Stok::with('barang')->get(); // Eager load barang relation
        return response()->json($stocks);
    }

    /**
     * Menambahkan atau mengurangi stok.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_stok' => 'required|integer',
            'operation' => 'required|in:add,subtract',
        ]);

        $stok = Stok::findOrFail($id);

        $jumlahStok = $request->input('jumlah_stok');
        $operation = $request->input('operation');

        if ($operation == 'add') {
            $stok->jumlah_stok += $jumlahStok;
        } elseif ($operation == 'subtract') {
            $stok->jumlah_stok -= $jumlahStok;
        }

        $stok->save();

        return response()->json($stok);
    }
}
