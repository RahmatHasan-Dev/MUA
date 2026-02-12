<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = [
        'no_transaksi',
        'judul',
        'nominal',
        'tanggal',
        'kategori',
        'bukti',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}