<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunFact extends Model
{
    use HasFactory;

    protected $table = 'funfact';
    protected $primaryKey = 'id_funfact';
    protected $guarded = [];
    
    protected $fillable = [
        'emoji',
        'angka',
        'headline',
        'deskripsi',
    ];

    public $timestamps = false;
}