<?php

namespace App\Mail;

use App\Models\Oferta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OfertaGerenteMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $oferta;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $oferta)
    {
        //
        // dd($user,$oferta);
        $this->user = $user;
        $this->oferta = $oferta;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Oferta Gerente Mailable',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.ofertaGerente',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
