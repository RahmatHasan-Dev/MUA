<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarLike extends Model
{
    use HasFactory;

    protected $table = 'komentar_likes';
    protected $fillable = ['id_komentar', 'id_user'];
}