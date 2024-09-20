<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang'; // Pastikan menggunakan nama tabel yang benar, lowercase

    protected $fillable = ['name', 'description'];

    // Relasi dengan Stok
    public function stok()
    {
        return $this->hasOne(Stok::class);
    }
    public function files()
    {
        return $this->hasMany(BarangFile::class, 'barang_id');
    }
}
