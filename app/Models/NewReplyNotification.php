<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Komentar;

class NewReplyNotification extends Notification
{
    use Queueable;

    public $komentar;

    public function __construct(Komentar $komentar)
    {
        $this->komentar = $komentar;
    }

    public function via($notifiable)
    {
        return ['database']; // Simpan ke database. Bisa tambah 'mail' jika ingin kirim email.
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->komentar->user->nama . ' membalas komentar Anda.',
            'url' => route('kegiatan.detail', $this->komentar->id_berita),
            'komentar_id' => $this->komentar->id
        ];
    }
}