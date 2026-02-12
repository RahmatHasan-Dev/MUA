<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LaporanDonasiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfData;

    public function __construct($pdfData)
    {
        $this->pdfData = $pdfData;
    }

    public function build()
    {
        return $this->subject('Laporan Donasi MUA')
                    ->view('emails.laporan_donasi')
                    ->attachData($this->pdfData, 'laporan_donasi.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}