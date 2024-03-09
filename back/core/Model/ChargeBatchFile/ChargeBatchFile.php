<?php
declare(strict_types=1);

namespace DDD\Model\ChargeBatchFile;

class ChargeBatchFile
{

    protected ?int $id;

    protected string $name;

    protected ChargeBatchFileStatus $status;

    protected string $path;

    protected \DateTimeImmutable $createdAt;

    public function __construct(string $name, string $path)
    {
        $this->name = $name;
        $this->path = $path;
        $this->status = ChargeBatchFileStatus::PENDING;
        $this->createdAt = new \DateTimeImmutable();
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

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }


}
