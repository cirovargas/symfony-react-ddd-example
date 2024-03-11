<?php

namespace App\Event\Subscriber;

use DDD\Model\Charge\Command\SendChargeSavedEmailNotificationCommand;
use DDD\Model\Charge\Event\ChargeWasSaved;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ChargeEventSubscriber implements EventSubscriberInterface
{

    public function __construct(private MessageBusInterface $commandBus)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            ChargeWasSaved::class => 'onChargeWasSaved'
        ];
    }

    public function onChargeWasSaved(ChargeWasSaved $event)
    {
        $this->commandBus->dispatch(new SendChargeSavedEmailNotificationCommand($event->getCharge()->getId()));
    }

}
