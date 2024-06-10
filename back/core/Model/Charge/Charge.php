<?php
declare(strict_types=1);

namespace DDD\Model\Charge;
use DateTime;
use DDD\Model\ChargeBatchFile\ChargeBatchFile;

class Charge implements \JsonSerializable
{

    protected ?int $id;

    protected string $name;

    protected string $governmentId;

    protected string $email;

    protected float $debtAmount;

    protected DateTime $debtDueDate;

    protected string $debtID;

    protected DateTime $createdAt;

    protected ChargeBatchFile $chargeBatchFile;

    public function __construct(
        ChargeBatchFile $chargeBatchFile,
        string $name,
        string $governmentId,
        string $email,
        float $debtAmount,
        DateTime $debtDueDate,
        string $debtID
    ) {
        $this->chargeBatchFile = $chargeBatchFile;
        $this->name = $name;
        $this->governmentId = $governmentId;
        $this->email = $email;
        $this->debtAmount = $debtAmount;
        $this->debtDueDate = $debtDueDate;
        $this->debtID = $debtID;
        $this->createdAt = new DateTime();
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

    public function getDebtDueDate(): DateTime
    {
        return $this->debtDueDate;
    }

    public function getDebtID(): string
    {
        return $this->debtID;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getChargeBatchFile(): ChargeBatchFile
    {
        return $this->chargeBatchFile;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'governmentId' => $this->governmentId,
            'email' => $this->email,
            'debtAmount' => $this->debtAmount,
            'debtDueDate' => $this->debtDueDate->format('Y-m-d'),
            'debtID' => $this->debtID,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s')
        ];
    }

}
