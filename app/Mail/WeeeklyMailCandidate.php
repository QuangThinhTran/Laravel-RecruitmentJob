<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * @property $user
 * @property $post
 */
class WeeeklyMailCandidate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct
    (
        $user_detail,
        $post_detail
    )
    {
        $this->user = $user_detail;
        $this->post = $post_detail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: mb_encode_mimeheader(env('MAIL_FROM_ADDRESS')),
            subject: 'CÁC CÔNG VIỆC BẠN KHÔNG THỂ BỎ LỠ TRONG TUẦN QUA'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.weeklyCandidate',
            with: [
                'username' => $this->user->name,
                'posts' => $this->post
            ]
        );
    }
}
