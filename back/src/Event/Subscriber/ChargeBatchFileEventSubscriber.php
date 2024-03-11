<?php

namespace App\Event\Subscriber;

use DDD\Model\ChargeBatchFile\Command\ProcessChargeBatchFileCommand;
use DDD\Model\ChargeBatchFile\Event\ChargeBatchFileWasSavedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ChargeBatchFileEventSubscriber implements EventSubscriberInterface
{

    public function __construct(private MessageBusInterface $commandBus)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            ChargeBatchFileWasSavedEvent::class => 'onChargeBatchFileWasSaved'
        ];
    }

    public function onChargeBatchFileWasSaved(ChargeBatchFileWasSavedEvent $event)
    {
        $this->commandBus->dispatch(new ProcessChargeBatchFileCommand($event->getChargeBatchFile()->getId()));
    }

}
