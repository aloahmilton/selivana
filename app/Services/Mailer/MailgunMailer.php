<?php

namespace App\Services\Mailer;

use App\Contracts\MailerInterface;
use Illuminate\Support\Facades\Mail;

class MailgunMailer implements MailerInterface
{
    /**
     * Send an email using Mailgun
     *
     * @param string $to
     * @param string $subject
     * @param string $body
     * @param array $attachments
     * @return bool
     */
    public function send(string $to, string $subject, string $body, array $attachments = []): bool
    {
        try {
            // Laravel already includes Mailgun support
            // Just make sure to set MAIL_MAILER=mailgun in your .env
            Mail::raw($body, function ($message) use ($to, $subject, $attachments) {
                $message->to($to)
                    ->subject($subject);

                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            });

            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
