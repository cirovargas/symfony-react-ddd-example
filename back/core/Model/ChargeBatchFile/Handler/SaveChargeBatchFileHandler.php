<?php

namespace DDD\Model\ChargeBatchFile\Handler;

use DDD\Application\Event\EventRecorder;
use DDD\Application\Service\CsvReader;
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
        private CsvReader $csvReader,
        private EventRecorder $eventRecorder
    ) {
    }

    public function __invoke(SaveChargeBatchFileCommand $command): ChargeBatchFile
    {
        if (random_int(1,3) === 1) {
            throw new \RuntimeException('Random error');
        }

        $this->validateFile($command->getPathname(), $command->getFilename());

        $file = $this->storageService->save($command->getPathname(), $command->getFilename());

        $chargeBatchFile = $this->chargeBatchFileFactory->create(
            $file->getFilename(),
            $file->getPathname()
        );

        $this->chargeBatchFileRepository->save($chargeBatchFile);
        $this->eventRecorder->record(new ChargeBatchFileWasSavedEvent($chargeBatchFile));

        return $chargeBatchFile;
    }

    private function validateFile(string $pathname, string $filename): void
    {
        if (!file_exists($pathname)) {
            throw new \RuntimeException('File not found');
        }

        if (!is_readable($pathname)) {
            throw new \RuntimeException('File not readable');
        }

        if (pathinfo($filename, PATHINFO_EXTENSION) !== 'csv') {
            throw new \RuntimeException('Invalid file extension');
        }

        if (($handle = fopen($pathname, "r")) !== FALSE) {
            $data = fgetcsv($handle, 1000, ",");
            if ($data !== ['name', 'governmentId', 'email', 'debtAmount', 'debtDueDate', 'debtId']) {
                throw new \RuntimeException('Invalid header');
            }
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) !== 6) {
                    throw new \RuntimeException('Invalid number of columns');
                }

                if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data[4])) {
                    throw new \RuntimeException('Invalid debt due date');
                }

                if (!filter_var($data[2], FILTER_VALIDATE_EMAIL)) {
                    throw new \RuntimeException('Invalid email');
                }
            }
            fclose($handle);
        }

    }

}
