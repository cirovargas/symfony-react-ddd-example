<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Charge;
use DDD\Model\Charge\Charge as ModelCharge;
use DDD\Model\Charge\Service\ChargeFactory as ChargeFactoryInterface;

class ChargeFactory implements ChargeFactoryInterface
{
    public function create(
        string $name,
        string $governmentId,
        string $email,
        float $debtAmount,
        \DateTime $debtDueDate,
        string $debtID
    ): ModelCharge {
        return new Charge(
            $name,
            $governmentId,
            $email,
            $debtAmount,
            $debtDueDate,
            $debtID
        );
    }

}
