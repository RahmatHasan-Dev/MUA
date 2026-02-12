<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';

    protected $fillable = [
        'id_user',
        'id_campaign',
        'jenis',
        'nominal',
        'status',
        'snap_token',
        'catatan',
        'bukti_transfer',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'id_campaign');
    }
}