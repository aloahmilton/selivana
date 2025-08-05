<?php

namespace App\Providers;

use App\Contracts\MailerInterface;
use App\Services\Mailer\SmtpMailer;
use App\Services\Mailer\MailgunMailer;
use App\Services\Mailer\SendgridMailer;
use Illuminate\Support\ServiceProvider;

class MailerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MailerInterface::class, function ($app) {
            // Get the default mailer from config
            $default = config('mail.default');

            return match ($default) {
                'smtp' => new SmtpMailer(),
                'mailgun' => new MailgunMailer(),
                'sendgrid' => new SendgridMailer(),
                default => new SmtpMailer(),
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
