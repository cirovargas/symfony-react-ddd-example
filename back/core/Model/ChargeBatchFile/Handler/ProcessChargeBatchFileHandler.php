<?php
declare(strict_types=1);

namespace DDD\Model\ChargeBatchFile\Handler;

use DDD\Application\Service\CsvReader;
use DDD\Application\Service\StorageService;
use DDD\Model\Charge\Command\SaveChargeCommand;
use DDD\Model\ChargeBatchFile\ChargeBatchFile;
use DDD\Model\ChargeBatchFile\Command\ProcessChargeBatchFileCommand;
use DDD\Model\ChargeBatchFile\Repository\ChargeBatchFileRepository;
use Symfony\Component\Messenger\MessageBusInterface;

class ProcessChargeBatchFileHandler
{
    public function __construct(
        private ChargeBatchFileRepository $chargeBatchFileRepository,
        private StorageService $storageService,
        private CsvReader $csvReader,
        private MessageBusInterface $commandBus
    ) {
    }

    public function __invoke(ProcessChargeBatchFileCommand $command): void
    {
        $chargeBatchFile = $this->chargeBatchFileRepository->get($command->getChargeBatchFileId());

        try {

            if (random_int(1,2) === 1) {
                throw new \RuntimeException('Random error');
            }


            $data = $this->csvReader->csvToArray(
                $chargeBatchFile->getPath(),
                ',',
                100,
                range('A', 'F'),
                true
            );
            foreach ($data as $chunk) {
                $this->parseChunkData($chargeBatchFile, $chunk);
            }

            $chargeBatchFile->processed();
        } catch (\Exception $e) {
            $chargeBatchFile->failed();
            echo $e->getMessage().PHP_EOL;
        }
        finally {
            $this->chargeBatchFileRepository->save($chargeBatchFile);
        }
    }

    private function parseChunkData(ChargeBatchFile $chargeBatchFile, array $chunk): void
    {
        foreach ($chunk as $charge) {
            $this->dispatchCharge($chargeBatchFile, $charge);
        }
    }

    private function dispatchCharge(ChargeBatchFile $chargeBatchFile,array $charge): void
    {
        if(!isset($charge['A'])) {
            echo "Invalid charge data".PHP_EOL;
            return;
        }

        $this->commandBus->dispatch(
            new SaveChargeCommand(
                $chargeBatchFile->getId(),
                $charge['A'],
                $charge['B'],
                $charge['C'],
                (float)$charge['D'],
                \DateTime::createFromFormat('!Y-m-d+', $charge['E']),
                $charge['F']
            )
        );
    }

}
