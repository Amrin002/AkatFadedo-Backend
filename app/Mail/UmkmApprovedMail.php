<?php

namespace App\Mail;

use App\Models\Umkm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UmkmApprovedMail extends Mailable
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
            subject: 'UMKM Anda Telah Disetujui - ' . $this->umkm->nama_usaha,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.umkm-approved',
            with: [
                'umkm' => $this->umkm,
                'tanggal_approval' => $this->umkm->approved_at ? $this->umkm->approved_at->format('d F Y, H:i') : now()->format('d F Y, H:i'),
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