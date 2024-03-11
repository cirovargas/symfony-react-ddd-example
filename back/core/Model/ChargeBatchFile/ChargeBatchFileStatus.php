<?php
declare(strict_types=1);

namespace DDD\Model\ChargeBatchFile;

enum ChargeBatchFileStatus: string
{
    case PENDING = 'PENDING';

    case FAILED = 'FAILED';

    case PROCESSED = 'PROCESSED';

}