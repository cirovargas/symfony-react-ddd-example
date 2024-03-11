<?php

namespace DDD\Model\Charge\Repository;

use DDD\Application\Repository\AbstractRepository;
use DDD\Model\Charge\Charge;

interface ChargeRepository extends AbstractRepository
{

    public function get(int $id): ?Charge;


}
