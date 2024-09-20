<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Stok;
use App\Models\BarangFile;
use Illuminate\Http\Request;
use Validator;

class BarangApi extends Controller
{
    public function index()
    {
        // Load barang with stok and files
        $barang = Barang::with(['stok', 'files'])->get();

        return response()->json([
            'success' => true,
            'data' => $barang,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi untuk barang, stok, dan file
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stok' => 'required|integer|min:1',
            'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Validasi file
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Membuat barang
        $barang = Barang::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Membuat stok untuk barang tersebut
        Stok::create([
            'barang_id' => $barang->id,
            'jumlah_stok' => $request->stok,
        ]);

        // Cek apakah ada file yang diunggah
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public'); // Simpan file

            // Simpan file di tabel files
            $barang->files()->create([
                'filename' => $filename,
                'path' => $path,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Barang successfully created with Stok and File',
            'data' => $barang,
        ], 201);
    }

    public function show($id)
    {
        // Load barang bersama stok dan files
        $barang = Barang::with(['stok', 'files'])->find($id);

        if (is_null($barang)) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $barang,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (is_null($barang)) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }

        // Validasi untuk barang, stok, dan file
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stok' => 'required|integer|min:1',
            'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Validasi file
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Update barang
        $barang->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Update stok yang terkait dengan barang
        $stok = Stok::where('barang_id', $barang->id)->first();
        if ($stok) {
            $stok->update(['jumlah_stok' => $request->stok]);
        } else {
            Stok::create([
                'barang_id' => $barang->id,
                'jumlah_stok' => $request->stok,
            ]);
        }

        // Cek apakah ada file yang diunggah
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public'); // Simpan file

            // Simpan file di tabel files
            $barang->files()->create([
                'filename' => $filename,
                'path' => $path,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Barang successfully updated with Stok and File',
            'data' => $barang,
        ], 200);
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (is_null($barang)) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }

        // Hapus stok yang terkait dengan barang
        Stok::where('barang_id', $barang->id)->delete();

        // Hapus file yang terkait dengan barang dari storage dan database
        foreach ($barang->files as $file) {
            // Hapus file dari storage
            \Storage::disk('public')->delete($file->path);

            // Hapus file dari database
            $file->delete();
        }

        // Hapus barang
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang and associated Stok and Files successfully deleted',
        ], 200);
    }
}
