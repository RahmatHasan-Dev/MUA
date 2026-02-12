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

    // Relasi ke User (versi User)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke User (versi Pengguna, sesuai migrasi)
    public function pelapor()
    {
        return $this->belongsTo(Pengguna::class, 'id_user');
    }
}
