<?php

namespace App\Mail;

use App\Models\Umkm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UmkmRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $umkm;

    /**
     * Create a new message instance.
     */
    public function __construct(Umkm $umkm)
    {
        $this->umkm = $umkm;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pendaftaran UMKM Perlu Diperbaiki - ' . $this->umkm->nama_usaha,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.umkm-rejected',
            with: [
                'umkm' => $this->umkm,
                'catatan_admin' => $this->umkm->catatan_admin,
                'tanggal_rejection' => now()->format('d F Y, H:i'),
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
        return [];
    }
}