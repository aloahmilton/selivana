<?php

namespace App\Contracts;

interface MailerInterface
{
    /**
     * Send an email
     *
     * @param string $to
     * @param string $subject
     * @param string $body
     * @param array $attachments
     * @return bool
     */
    public function send(string $to, string $subject, string $body, array $attachments = []): bool;
}
