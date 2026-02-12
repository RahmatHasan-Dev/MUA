<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Komentar;
use Illuminate\Support\Str;

class NewReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $komentar;

    /**
     * Create a new notification instance.
     */
    public function __construct(Komentar $komentar)
    {
        $this->komentar = $komentar;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Balasan Baru pada Komentar Anda - MUA')
            ->greeting('Halo ' . $notifiable->nama . ',')
            ->line('Seseorang baru saja membalas komentar Anda pada kegiatan kami.')
            ->line('Isi balasan: "' . Str::limit($this->komentar->isi, 100) . '"')
            ->action('Lihat Balasan', url('/kegiatan/' . $this->komentar->id_berita))
            ->line('Terima kasih telah berpartisipasi dalam diskusi MUA.');
    }
}
