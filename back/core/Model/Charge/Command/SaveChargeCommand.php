<?php
declare(strict_types=1);

namespace DDD\Model\Charge\Command;

final class SaveChargeCommand
{
    protected string $name;

    protected string $governmentId;

    protected string $email;

    protected float $debtAmount;

    protected \DateTime $debtDueDate;

    protected string $debtID;

    public function __construct(
        string $name,
        string $governmentId,
        string $email,
        float $debtAmount,
        \DateTime $debtDueDate,
        string $debtID
    ) {
        $this->name = $name;
        $this->governmentId = $governmentId;
        $this->email = $email;
        $this->debtAmount = $debtAmount;
        $this->debtDueDate = $debtDueDate;
        $this->debtID = $debtID;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGovernmentId(): string
    {
        return $this->governmentId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDebtAmount(): float
    {
        return $this->debtAmount;
    }

    public function getDebtDueDate(): \DateTime
    {
        return $this->debtDueDate;
    }

    public function getDebtID(): string
    {
        return $this->debtID;
    }

}
