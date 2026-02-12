<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Donasi;

class DonasiBerhasilMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donasi;

    /**
     * Create a new message instance.
     */
    public function __construct(Donasi $donasi)
    {
        $this->donasi = $donasi;
    }

    public function build()
    {
        return $this->subject('Terima Kasih! Donasi Anda Berhasil - MUA')
                    ->view('emails.donasi_sukses');
    }
}