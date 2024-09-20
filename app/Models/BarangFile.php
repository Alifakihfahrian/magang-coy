<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangFile extends Model
{
    protected $table = 'files'; // Sesuaikan dengan nama tabel
    public $timestamps = true; // Aktifkan timestamps jika digunakan
    protected $fillable = ['filename', 'path', 'barang_id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
