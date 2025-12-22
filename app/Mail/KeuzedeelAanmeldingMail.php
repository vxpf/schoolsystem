<?php

namespace App\Mail;

use App\Models\Keuzedeel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KeuzedeelAanmeldingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $keuzedeel;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Keuzedeel $keuzedeel)
    {
        $this->user = $user;
        $this->keuzedeel = $keuzedeel;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Bevestiging Aanmelding Keuzedeel - ' . $this->keuzedeel->naam,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.keuzedeel-aanmelding',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
