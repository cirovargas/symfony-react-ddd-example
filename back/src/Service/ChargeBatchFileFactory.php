<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\ChargeBatchFile;
use DDD\Model\ChargeBatchFile\ChargeBatchFile as ModelChargeBatchFile;
use DDD\Model\ChargeBatchFile\Service\ChargeBatchFileFactory as ChargeBatchFileFactoryInterface;

class ChargeBatchFileFactory implements ChargeBatchFileFactoryInterface
{
    public function create(string $name, string $path): ModelChargeBatchFile
    {
        return new ChargeBatchFile($name, $path);
    }

}