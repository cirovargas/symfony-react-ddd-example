<?php
declare(strict_types=1);

namespace DDD\Model\Charge\Service;

use DDD\Model\Charge\Charge;
use DDD\Model\ChargeBatchFile\ChargeBatchFile;

interface ChargeFactory
{

    public function create(
        ChargeBatchFile $chargeBatchFile,
        string $name,
        string $governmentId,
        string $email,
        float $debtAmount,
        \DateTime $debtDueDate,
        string $debtID
    ): Charge;

}
