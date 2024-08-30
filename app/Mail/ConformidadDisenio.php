<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConformidadDisenio extends Mailable
{
    use Queueable, SerializesModels;
public $pedido;
public $cliente;
public $producto ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pedido,$cliente,$producto)
    {
        //
        $this->pedido= $pedido;
        $this->cliente=$cliente;
        $this->producto=$producto;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Conformidad Disenio',
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
            view: 'emails.conformidadDisenio',
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
