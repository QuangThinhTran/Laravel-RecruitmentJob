<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * @property $post_not_approved
 * @property $post_approved
 * @property $start_date
 * @property $end_date
 */
class StatisticalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct
    (
        $post_not_approved,
        $post_approved,
        $from,
        $to
    )
    {
        $this->post_not_approved = $post_not_approved;
        $this->post_approved = $post_approved;
        $this->start_date = $from;
        $this->end_date = $to;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: mb_encode_mimeheader(env('MAIL_FROM_ADDRESS')),
            subject: 'THỐNG KÊ NHỮNG BÀI VIẾT TRONG TUẦN QUA',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.statisticalEmail',
            with: [
                'approved' => $this->post_approved,
                'not_approved' => $this->post_not_approved,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'sum' => $this->post_approved + $this->post_not_approved
            ]
        );
    }
}
