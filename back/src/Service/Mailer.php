<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Mailer implements \DDD\Application\Service\Mailer
{

    public function __construct(private MailerInterface $mailer)
    {
    }

    public function send(string $to, string $subject, string $body): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($to)
            ->subject($subject)
            ->text($body);

        $this->mailer->send($email);
    }
}
