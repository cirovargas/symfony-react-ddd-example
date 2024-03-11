<?php

namespace DDD\Model\ChargeBatchFile\Repository;

use DDD\Application\Repository\AbstractRepository;
use DDD\Model\ChargeBatchFile\ChargeBatchFile;

interface ChargeBatchFileRepository extends AbstractRepository
{

    public function get(int $id): ?ChargeBatchFile;

}
