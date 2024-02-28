<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DisenoRealizado extends Mailable
{
    use Queueable, SerializesModels;
    public $pedido, $producto, $cliente, $empresa;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pedido, $producto, $cliente, $empresa)
    {
        //    recibir Empresa, cliente, pedido, diseño etc. 
        $this->pedido = $pedido;
        $this->producto = $producto;
        $this->cliente = $cliente;
        $this->empresa = $empresa;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Diseño Realizado',
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
            view: 'emails.diseno_realizado',
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
