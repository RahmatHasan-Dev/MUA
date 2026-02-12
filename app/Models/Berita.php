<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'tanggal',
        'lokasi',
        'peserta',
        'tag1',
        'tag2',
        'tag3',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_berita')->orderBy('created_at', 'desc');
    }
}