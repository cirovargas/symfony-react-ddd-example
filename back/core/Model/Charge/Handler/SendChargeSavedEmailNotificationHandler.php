<?php

namespace DDD\Model\Charge\Handler;

use DDD\Application\Service\Mailer;
use DDD\Model\Charge\Command\SendChargeSavedEmailNotificationCommand;
use DDD\Model\Charge\Repository\ChargeRepository;

class SendChargeSavedEmailNotificationHandler
{

    public function __construct(
        private ChargeRepository $chargeRepository,
        private Mailer $emailService
    ) {
    }

    public function __invoke(SendChargeSavedEmailNotificationCommand $command): void
    {
        if (random_int(1,3) === 1) {
            throw new \RuntimeException('Random error');
        }

        $charge = $this->chargeRepository->find($command->getChargeId());
        $this->emailService->send(
            $charge->getEmail(),
            'Charge Saved',
            'Your charge has been saved'
        );
    }

}
