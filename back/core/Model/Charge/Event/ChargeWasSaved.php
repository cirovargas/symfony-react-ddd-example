<?php
declare(strict_types=1);
namespace DDD\Model\Charge\Event;

use DDD\Application\Event\Event;
use DDD\Model\Charge\Charge;

class ChargeWasSaved implements Event
{


    public function __construct(
        private Charge $charge
    ) {
    }

    public function getCharge(): Charge
    {
        return $this->charge;
    }


}
