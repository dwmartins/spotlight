<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: trans('messages.email_subject'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $logo = url(config('website_info.logoImage'));

        return new Content(
            view: 'emails.user.reset-password',
            with: [
                'websiteLogo' => $logo,
                'user'=> $this->user,
                'resetUrl' => url(trans('navigation.reset_password') . '/' . $this->token)
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
