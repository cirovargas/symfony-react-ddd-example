<?php
declare(strict_types=1);

namespace DDD\Model\ChargeBatchFile;
use DateTime;

class ChargeBatchFile implements \JsonSerializable
{

    protected ?int $id;

    protected string $name;

    protected ChargeBatchFileStatus $status;

    protected string $path;

    protected DateTime $createdAt;

    protected iterable $charges;

    public function __construct(string $name, string $path)
    {
        $this->name = $name;
        $this->path = $path;
        $this->status = ChargeBatchFileStatus::PENDING;
        $this->createdAt = new DateTime();
        $this->charges = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): ChargeBatchFileStatus
    {
        return $this->status;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function failed(): void
    {
        $this->status = ChargeBatchFileStatus::FAILED;
    }

    public function processed(): void
    {
        $this->status = ChargeBatchFileStatus::PROCESSED;
    }

    public function getCharges(): iterable
    {
        return $this->charges;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'path' => $this->path,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s')
        ];
    }
}
