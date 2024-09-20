<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stok';

    protected $fillable = ['barang_id', 'jumlah_stok'];

    // Relasi dengan Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
