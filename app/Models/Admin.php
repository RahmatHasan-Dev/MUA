<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Map to the 'admin' table from your SQL
    protected $table = 'admin';

    // The table does not have created_at/updated_at timestamps
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function setRememberToken($value)
    {
        // Do nothing
    }

    public function getRememberToken()
    {
        return null;
    }
}