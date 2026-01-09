<?php

namespace App\Mail;

use App\Models\Donasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $donasi;

    public function __construct(Donasi $donasi)
    {
        $this->donasi = $donasi;
    }

    public function build()
    {
        return $this->subject('Update Status Donasi - MUA')
                    ->view('emails.donation_status');
    }
}