<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Map to the 'pengguna' table from your SQL
    protected $table = 'pengguna';

    // The table does not have created_at/updated_at timestamps
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'tgl_lahir',
        'no_hp',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];
}