<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * @property $name
 * @property $email
 */
class NotificationRestoreUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct
    (
        $name,
        $email
    )
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: mb_encode_mimeheader(env('MAIL_FROM_ADDRESS')),
            subject: 'THÔNG BÁO KHÔI PHỤC TÀI KHOẢN',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.notificationRestoreUser',
            with: [
                'name' => $this->name,
                'email' => $this->email
            ]
        );
    }
}
