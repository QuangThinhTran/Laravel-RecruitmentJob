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
class WeeklyMailCompany extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct
    (
        $get_user,
        $get_post
    )
    {
        $this->user = $get_user;
        $this->post = $get_post;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: mb_encode_mimeheader(env('MAIL_FROM_ADDRESS')),
            subject: 'NHỮNG ỨNG CỬ VIÊN ĐÃ ỨNG TUYỂN BÀI VIẾT CỦA BẠN TRONG TUẦN QUA',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.weeklyCompany',
            with: [
                'users' => $this->user,
                'posts' => $this->post
            ]
        );
    }

}
