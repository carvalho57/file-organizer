<?php

namespace FileOrganizer;

use DateTimeImmutable;

class File implements \Stringable
{
    private string $path;
    private DateTimeImmutable $createTime;
    private string $extension;
    private int $size;


    public function __construct(\SplFileInfo $file)
    {
        $this->path = $file->getRealPath();
        $this->createTime = (new DateTimeImmutable())->setTimestamp($file->getCTime());
        $this->extension = $file->getExtension();
        $this->size = $file->getSize();
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getCreateDate(): DateTimeImmutable
    {
        return $this->createTime;
    }

    public function getSizeMb(): int
    {
        return $this->size / 1024;
    }

    public function moveTo(string $destination)
    {
        $destinationPath = $destination . DIRECTORY_SEPARATOR . basename($this->getPath());

        !is_dir($destination) && mkdir($destination, 0744, true);

        if (copy($this->getPath(), $destinationPath)) {
            //remover depois ou usar o rename
        }
    }

    public function __toString()
    {
        return json_encode([
            'path' => $this->getPath(),
            'filename' => basename($this->getPath()),
        ]);
    }
}
