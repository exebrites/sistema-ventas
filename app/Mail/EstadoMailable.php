<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EstadoMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $estado, $cliente, $nroPedido;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($estado, $cliente, $nroPedido)
    {
        // dd($nroPedido);
        $this->estado = $estado;
        $this->cliente = $cliente;
        $this->$nroPedido =  $nroPedido;
        // dd($this->$nroPedido);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Estado de tu pedido',
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
            view: 'emails.estado',
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
