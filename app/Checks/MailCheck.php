<?php

namespace App\Checks;

use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class MailCheck extends Check
{
    public function run(): Result
    {
        $this->label = 'Mail ('.config('mail.default').')';

        switch (config('mail.default')) {
            case 'smtp':
                return $this->checkSmtp();

            default:
                $result = Result::make();

                return $result->failed('Mailer '.config('mail.default').' is not supported');
        }
    }

    private function checkSmtp(): Result
    {
        $result = Result::make();

        try {
            $transport = new EsmtpTransport(config('mail.mailers.smtp.host'), config('mail.mailers.smtp.port'), false);
            $transport->setUsername(config('mail.mailers.smtp.username'));
            $transport->setPassword(config('mail.mailers.smtp.password'));
            $transport->start();

            return $result->ok();
        } catch (\Exception $e) {
            return $result->failed($e->getMessage());
        }
    }
}
