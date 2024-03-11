<?php
declare(strict_types=1);

namespace DDD\Model\Charge\Command;

class SendChargeSavedEmailNotificationCommand
{

    public function __construct(
        private int $chargeId
    ) {
    }

    public function getChargeId(): int
    {
        return $this->chargeId;
    }

}
