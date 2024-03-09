<?php
declare(strict_types=1);

namespace DDD\Model\Charge;

class Charge
{

    protected ?int $id;

    protected string $name;

    protected string $governmentId;

    protected string $email;

    protected float $debtAmount;

    protected \DateTimeImmutable $debtDueDate;

    protected string $debtID;

    protected \DateTimeImmutable $createdAt;

    public function __construct(
        string $name,
        string $governmentId,
        string $email,
        float $debtAmount,
        \DateTimeImmutable $debtDueDate,
        string $debtID
    ) {
        $this->name = $name;
        $this->governmentId = $governmentId;
        $this->email = $email;
        $this->debtAmount = $debtAmount;
        $this->debtDueDate = $debtDueDate;
        $this->debtID = $debtID;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDebtDueDate(): \DateTimeImmutable
    {
        return $this->debtDueDate;
    }

    public function getDebtID(): string
    {
        return $this->debtID;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

}
