<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuratApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $surat;
    /**
     * Create a new message instance.
     */
    public function __construct($surat)
    {
        //
        $this->surat = $surat;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        $subject = $this->getSubjectBasedOnType($this->surat->type_surat);
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.surat_approved',
            with: [
                'noSurat' => $this->surat->no_surat,
                'tanggalTerbit' => $this->surat->tanggal_terbit,
                'typeSurat' => $this->surat->type_surat,
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
    private function getSubjectBasedOnType($typeSurat)
    {
        switch ($typeSurat) {
            case 'Surat Keterangan Tempat Usaha':
                return 'Surat Keterangan Tempat Usaha Anda Telah Disetujui';
            case 'Surat Keterangan Domisili':
                return 'Surat Domisili Anda Telah Disetujui';
            case 'Surat Keterangan Tidak Mampu':
                return 'Surat Keterangan Tidak Mampu Anda Telah Disetujui';
            case 'Surat Keterangan Pindah Domisili':
                return 'Surat Pindah Anda Telah Disetujui';
            default:
                return 'Surat Anda Telah Disetujui';
        }
    }
}
