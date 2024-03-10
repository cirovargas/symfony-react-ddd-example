<?php

namespace DDD\Model\ChargeBatchFile\Handler;

use DDD\Application\Service\StorageService;
use DDD\Model\ChargeBatchFile\ChargeBatchFile;
use DDD\Model\ChargeBatchFile\Command\SaveChargeBatchFileCommand;
use DDD\Model\ChargeBatchFile\Repository\ChargeBatchFileRepository;
use DDD\Model\ChargeBatchFile\Service\ChargeBatchFileFactory;

class SaveChargeBatchFileHandler
{
    public function __construct(
        private ChargeBatchFileRepository $chargeBatchFileRepository,
        private StorageService $storageService,
        private ChargeBatchFileFactory $chargeBatchFileFactory
    ) {
    }

    public function __invoke(SaveChargeBatchFileCommand $command): ChargeBatchFile
    {
        $file = $this->storageService->save($command->getPathname(), $command->getFilename());

        $chargeBatchFile = $this->chargeBatchFileFactory->create(
            $file->getPathname(),
            $file->getFilename()
        );

        $this->chargeBatchFileRepository->save($chargeBatchFile);

        return $chargeBatchFile;
    }

}