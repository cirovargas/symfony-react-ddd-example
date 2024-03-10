<?php
declare(strict_types=1);

namespace DDD\Model\ChargeBatchFile\Command;

class SaveChargeBatchFileCommand
{
    public function __construct(
        private string $pathname,
        private string $filename
    ) {
    }

    public function getPathname(): string
    {
        return $this->pathname;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

}