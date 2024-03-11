<?php
declare(strict_types=1);

namespace DDD\Model\Charge\Service;

use DDD\Model\Charge\Charge;

interface ChargeFactory
{

    public function create(
        string $name,
        string $governmentId,
        string $email,
        float $debtAmount,
        \DateTime $debtDueDate,
        string $debtID
    ): Charge;

}
