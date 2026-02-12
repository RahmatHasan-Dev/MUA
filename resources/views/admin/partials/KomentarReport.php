<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarReport extends Model
{
    use HasFactory;

    protected $table = 'komentar_reports';

    protected $fillable = ['id_komentar', 'id_user', 'alasan', 'status'];

    // Relasi ke Komentar yang dilaporkan
    public function komentar()
    {
        return $this->belongsTo(Komentar::class, 'id_komentar');
    }

    // Relasi ke User (Pelapor) - Mengacu pada tabel 'pengguna' sesuai migrasi
    public function pelapor()
    {
        return $this->belongsTo(Pengguna::class, 'id_user');
    }
}