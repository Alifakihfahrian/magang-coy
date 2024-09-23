<?php

namespace App\Http\Controllers;

use App\Models\BarangFile;
use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all(); 
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        return view('barangs.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'jumlah_stok' => 'required|integer',
        'files.*' => 'file|mimes:jpg,png,pdf|max:2048',
    ]);

    $barang = Barang::create($request->only('name', 'description'));

    $barang->stok()->create([
        'jumlah_stok' => $request->jumlah_stok,
    ]);

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('uploads', 'public');
            BarangFile::create([
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'barang_id' => $barang->id,
            ]);
        }
    }

    return redirect()->route('barangs.index')->with('success', 'Barang created successfully.');
}



    public function show(Barang $barang)
    {
    $stok = $barang->stok; 

    return view('barangs.show', compact('barang', 'stok'));
    }


    public function edit(Barang $barang)
    {
        return view('barangs.edit', compact('barang'));
    }

    public function update(Request $request, $id)
{
    $barang = Barang::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'jumlah_stok' => 'required|integer',
        'stok_type' => 'required|string|in:add,subtract',
        'stok_amount' => 'required|integer|min:1',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Update barang data (name, description)
    $barang->update($request->only('name', 'description'));

    // Logika penambahan atau pengurangan stok
    $stok = $barang->stok;
    $stok_amount = $request->stok_amount;

    if ($request->stok_type == 'add') {
        $stok->jumlah_stok += $stok_amount;
    } elseif ($request->stok_type == 'subtract') {
        $stok->jumlah_stok -= $stok_amount;
    }

    $stok->save();

    // Logika untuk file (jika ada)
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('uploads', 'public');
            BarangFile::create([
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'barang_id' => $barang->id,
            ]);
        }
    }

    return redirect()->route('barangs.index')->with('success', 'Barang updated successfully');
}


    public function destroy(Barang $barang)
    {
        $barang->stok()->delete(); 

        $barang->delete();

        return redirect()->route('barangs.index')->with('success', 'Barang deleted successfully.');
    }

}