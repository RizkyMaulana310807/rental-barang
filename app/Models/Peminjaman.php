<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'id_user',
        'id_barang',
        'tanggal_pinjam',
        'tanggal_kembali',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];
    
}
