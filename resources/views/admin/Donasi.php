<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id_donasi'; // Sesuaikan dengan primary key tabel
    
    protected $guarded = []; // Mengizinkan semua kolom diisi (mass assignment)
}