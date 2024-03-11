<?php

namespace DDD\Model\ChargeBatchFile\Handler;

use DDD\Application\Event\EventRecorder;
use DDD\Application\Service\StorageService;
use DDD\Model\ChargeBatchFile\ChargeBatchFile;
use DDD\Model\ChargeBatchFile\Command\SaveChargeBatchFileCommand;
use DDD\Model\ChargeBatchFile\Event\ChargeBatchFileWasSavedEvent;
use DDD\Model\ChargeBatchFile\Repository\ChargeBatchFileRepository;
use DDD\Model\ChargeBatchFile\Service\ChargeBatchFileFactory;

class SaveChargeBatchFileHandler
{
    public function __construct(
        private ChargeBatchFileRepository $chargeBatchFileRepository,
        private StorageService $storageService,
        private ChargeBatchFileFactory $chargeBatchFileFactory,
        private EventRecorder $eventRecorder
    ) {
    }

    public function __invoke(SaveChargeBatchFileCommand $command): ChargeBatchFile
    {
        $file = $this->storageService->save($command->getPathname(), $command->getFilename());

        $chargeBatchFile = $this->chargeBatchFileFactory->create(
            $file->getFilename(),
            $file->getPathname()
        );

        $this->chargeBatchFileRepository->save($chargeBatchFile);
        $this->eventRecorder->record(new ChargeBatchFileWasSavedEvent($chargeBatchFile));

        return $chargeBatchFile;
    }

}
