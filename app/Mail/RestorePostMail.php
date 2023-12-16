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
 * @property $post_id
 */
class RestorePostMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct
    (
        $name,
        $mail,
        $post_id
    )
    {
        $this->name = $name;
        $this->email = $mail;
        $this->post_id = $post_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: mb_encode_mimeheader(env('MAIL_FROM_ADDRESS')),
            subject: 'THÔNG BÁO KHÔI PHỤC BÀI VIẾT',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.notificationRestorePost',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'post_id' => $this->post_id
            ]
        );
    }
}
