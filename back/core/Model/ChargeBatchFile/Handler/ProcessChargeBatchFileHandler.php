<?php
declare(strict_types=1);

namespace DDD\Model\ChargeBatchFile\Handler;

use DDD\Application\Service\StorageService;
use DDD\Model\ChargeBatchFile\Command\ProcessChargeBatchFileCommand;
use DDD\Model\ChargeBatchFile\Repository\ChargeBatchFileRepository;

class ProcessChargeBatchFileHandler
{
    public function __construct(
        private ChargeBatchFileRepository $chargeBatchFileRepository,
        private StorageService $storageService
    ) {
    }

    public function __invoke(ProcessChargeBatchFileCommand $command): void
    {
        $chargeBatchFile = $this->chargeBatchFileRepository->get($command->getChargeBatchFileId());
        $file = $this->storageService->get($chargeBatchFile->getPathname());
        $this->process($file);
    }


}