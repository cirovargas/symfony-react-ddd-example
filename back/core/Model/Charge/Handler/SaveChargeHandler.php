<?php

namespace DDD\Model\Charge\Handler;

use DDD\Application\Event\EventRecorder;
use DDD\Model\Charge\Command\SaveChargeCommand;
use DDD\Model\Charge\Event\ChargeWasSaved;
use DDD\Model\Charge\Repository\ChargeRepository;
use DDD\Model\Charge\Service\ChargeFactory;
use DDD\Model\ChargeBatchFile\Repository\ChargeBatchFileRepository;

class SaveChargeHandler
{

    public function __construct(
        private ChargeRepository $chargeRepository,
        private ChargeBatchFileRepository $chargeBatchFileRepository,
        private ChargeFactory $chargeFactory,
        private EventRecorder $eventRecorder
    ) {
    }

    public function __invoke(SaveChargeCommand $command): void
    {
        if (random_int(1,2) === 1) {
            throw new \RuntimeException('Random error');
        }

        $chargeBatchFile = $this->chargeBatchFileRepository->get($command->getChargeBatchFileId());

        $charge = $this->chargeFactory->create(
            $chargeBatchFile,
            $command->getName(),
            $command->getGovernmentId(),
            $command->getEmail(),
            $command->getDebtAmount(),
            $command->getDebtDueDate(),
            $command->getDebtID()
        );

        $this->chargeRepository->save($charge);

        $this->eventRecorder->record(new ChargeWasSaved($charge));
    }

}
