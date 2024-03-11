<?php
declare(strict_types=1);

namespace App\Service;

use DDD\Application\Service\StorageService as BaseStorageService;
use DDD\Application\ValueObject\StorageFile;

class StorageService implements BaseStorageService
{

    public function __construct(
        private string $storagePath
    ) {
    }

    public function save(string $pathname, string $filename): StorageFile
    {
        $name = md5(uniqid()).'.'.explode('.', $filename)[1];
        $file = $this->storagePath . DIRECTORY_SEPARATOR . $name;
        move_uploaded_file($pathname, $file);

        return new StorageFile($file, $filename);
    }

    public function get(string $filename): StorageFile
    {
        return new StorageFile($this->storagePath, $filename);
    }

}
