<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignedPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfPath;
    public $pdfName;
    public $recipientName;

    /**
     * Create a new message instance.
     */
    public function __construct($pdfPath, $pdfName, $recipientName = null)
    {
        $this->pdfPath = $pdfPath;
        $this->pdfName = $pdfName;
        $this->recipientName = $recipientName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Signed Vendor Contract',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pdf_sent', // your Blade template
            with: [
                'pdfName' => $this->pdfName,
                'pdfPath' => asset('storage/app/public/signed/' . basename($this->pdfPath)),
                'recipientName' => $this->recipientName,
            ]
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
            // Attachment::fromPath($this->pdfPath)
            //     ->as($this->pdfName)
            //     ->withMime('application/pdf'),
        ];
    }
}
