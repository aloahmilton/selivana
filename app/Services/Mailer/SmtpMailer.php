<?php

namespace App\Services\Mailer;

use App\Contracts\MailerInterface;
use Illuminate\Support\Facades\Mail;

class SmtpMailer implements MailerInterface
{
    /**
     * Send an email using Laravel's built-in SMTP mailer
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
