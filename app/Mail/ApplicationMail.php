<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mailContent;
    // protected $cvPath;
    
    /**
     * Create a new message instance.
     */
    public function __construct($mailContent)
    {
        $this->mailContent = $mailContent;
        // $this->cvPath = $cvPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'OPPBOARD New Application Alert!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.new_opp',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attachment::fromPath($this->cvPath)
            //     ->as('ApplicationCV.pdf')
            //     ->withMime('application/pdf'),
        ];
    }
}
