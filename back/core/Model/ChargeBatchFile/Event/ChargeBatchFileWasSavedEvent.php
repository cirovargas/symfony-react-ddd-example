<?php
declare(strict_types=1);

namespace DDD\Model\ChargeBatchFile\Event;

use DDD\Application\Event\Event;
use DDD\Model\ChargeBatchFile\ChargeBatchFile;

class ChargeBatchFileWasSavedEvent implements Event
{

    public function __construct(private ChargeBatchFile $chargeBatchFile)
    {
    }

    public function getChargeBatchFile(): ChargeBatchFile
    {
        return $this->chargeBatchFile;
    }

}
