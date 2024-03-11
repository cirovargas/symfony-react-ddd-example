<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Charge;
use DDD\Model\Charge\Repository\ChargeRepository as ChargeRepositoryInterface;

class ChargeRepository extends AbstractRepository implements ChargeRepositoryInterface
{
    public function get(int $id): ?Charge
    {
        return $this->find($id);
    }

    public function getEntityClassName(): string
    {
        return Charge::class;
    }

}
