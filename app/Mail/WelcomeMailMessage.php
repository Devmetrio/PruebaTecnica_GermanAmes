<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMailMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * El usuario al que se enviará el correo.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Obtiene el envelope del mensaje.
     * 
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Obtiene el envelope del mensaje.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenido a la plataforma',
        );
    }

    /**
     *  Obtiene el contenido del mensaje.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    /**
     * Obtiene los adjuntos para el mensaje.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
