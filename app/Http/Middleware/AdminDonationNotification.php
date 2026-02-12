<?php

namespace App\Mail;

use App\Models\Donasi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminDonationNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $donasi;

    /**
     * Create a new message instance.
     *
     * @param Donasi $donasi
     */
    public function __construct(Donasi $donasi)
    {
        $this->donasi = $donasi;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('🔔 Donasi Baru Masuk: Rp ' . number_format($this->donasi->nominal, 0, ',', '.'))
                    ->view('emails.admin_donation_notification');
    }
}