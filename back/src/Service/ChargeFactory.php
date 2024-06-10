<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Charge;
use DDD\Model\Charge\Charge as ModelCharge;
use DDD\Model\Charge\Service\ChargeFactory as ChargeFactoryInterface;
use DDD\Model\ChargeBatchFile\ChargeBatchFile;

class ChargeFactory implements ChargeFactoryInterface
{
    public function create(
        ChargeBatchFile $chargeBatchFile,
        string $name,
        string $governmentId,
        string $email,
        float $debtAmount,
        \DateTime $debtDueDate,
        string $debtID
    ): ModelCharge {
        return new Charge(
            $chargeBatchFile,
            $name,
            $governmentId,
            $email,
            $debtAmount,
            $debtDueDate,
            $debtID
        );
    }

}
