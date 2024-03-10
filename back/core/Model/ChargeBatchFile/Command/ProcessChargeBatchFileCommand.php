<?php
declare(strict_types=1);

namespace DDD\Model\ChargeBatchFile\Command;

class ProcessChargeBatchFileCommand
{
    public function __construct(private int $chargeBatchFileId)
    {
    }

    public function getChargeBatchFileId(): int
    {
        return $this->chargeBatchFileId;
    }

}