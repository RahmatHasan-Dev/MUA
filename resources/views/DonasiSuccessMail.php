<?php

namespace App\Mail;

use App\Models\Donasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonasiSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donasi;

    public function __construct(Donasi $donasi)
    {
        $this->donasi = $donasi;
    }

    public function build()
    {
        return $this->subject('Terima Kasih atas Donasi Anda - MUA')
                    ->view('emails.donasi_success');
    }
}