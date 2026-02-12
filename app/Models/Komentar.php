<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $guarded = [];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_user');
    }

    // Relasi ke User (untuk Notifikasi karena User punya trait Notifiable)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi Self-Referencing: Parent (Komentar Induk)
    public function parent()
    {
        return $this->belongsTo(Komentar::class, 'parent_id');
    }

    // Relasi Self-Referencing: Children (Balasan)
    public function replies()
    {
        return $this->hasMany(Komentar::class, 'parent_id')->with('pengguna');
    }
}
