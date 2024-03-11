<?php
declare(strict_types=1);

namespace DDD\Model\ChargeBatchFile\Service;

use DDD\Model\ChargeBatchFile\ChargeBatchFile;

interface ChargeBatchFileFactory
{

    public function create(string $name, string $path): ChargeBatchFile;

}
