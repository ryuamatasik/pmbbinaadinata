<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusPendaftaranEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $pendaftar;
    public $statusCheck; // 'Diterima', 'Ditolak', 'Verifikasi'
    public $catatan;

    /**
     * Create a new message instance.
     */
    public function __construct($pendaftar, $statusCheck, $catatan = null)
    {
        $this->pendaftar = $pendaftar;
        $this->statusCheck = $statusCheck;
        $this->catatan = $catatan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'Update Status Pendaftaran - Iteb Bina Adinata';
        if ($this->statusCheck == 'Diterima') {
            $subject = 'Selamat! Anda Diterima di Iteb Bina Adinata 🎉';
        } elseif ($this->statusCheck == 'Ditolak') {
            $subject = 'Pemberitahuan Hasil Seleksi Pendaftaran';
        } elseif ($this->statusCheck == 'Verifikasi') {
            $subject = 'Pendaftaran Sedang Diverifikasi - Iteb Bina Adinata';
        }

        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address(config('mail.from.address'), 'Iteb Bina Adinata'),
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.status_update',
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
