<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengajuanConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $items;
    public $staf;
    public $tanggal;

    public function __construct($items, $staf, $tanggal)
    {
        $this->items = $items;
        $this->staf = $staf;
        $this->tanggal = $tanggal;
    }

    public function build()
    {
        return $this->subject('Konfirmasi Pengajuan Inventaris')
                    ->view('emails.pengajuan_konfirmasi');
    }
}
