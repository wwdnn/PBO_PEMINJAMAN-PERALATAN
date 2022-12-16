<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\PinjamanDetail;

class TestHelloMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function build()
    {
        // create list data barang
        $peminjaman_details = PinjamanDetail::where('status_pinjam_barang', 'Terpinjam')->get();
        // return view('barangs.pdf', compact('barangs'));
        return $this->view('queue.dataPeminjamQueue', compact('peminjaman_details'));
    }
}
