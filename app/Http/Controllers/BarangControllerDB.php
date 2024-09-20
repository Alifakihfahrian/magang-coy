<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangControllerDB extends Controller
{
    public function index()
    {
        $barangs = DB::table('Barang')->get();
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
        ]);

        DB::table('Barang')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('barangs.index')->with('success', 'Barang created successfully.');
    }

    public function show($id)
    {
        $barang = DB::table('Barang')->where('id', $id)->first();
        return view('barangs.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = DB::table('Barang')->where('id', $id)->first();
        return view('barangs.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        DB::table('Barang')->where('id', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('barangs.index')->with('success', 'Barang updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('Barang')->where('id', $id)->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang deleted successfully.');
    }
}
