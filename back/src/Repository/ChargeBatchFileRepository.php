<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\ChargeBatchFile;
use DDD\Model\ChargeBatchFile\Repository\ChargeBatchFileRepository as ChargeBatchFileRepositoryInterface;

class ChargeBatchFileRepository extends AbstractRepository implements ChargeBatchFileRepositoryInterface
{
    public function get(int $id): ?ChargeBatchFile
    {
        return $this->find($id);
    }

    public function getEntityClassName(): string
    {
        return ChargeBatchFile::class;
    }

}
