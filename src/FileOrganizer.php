<?php

namespace FileOrganizer;

class FileOrganizer
{
    public function readDirectory(string $sourceDirectory, callable $filter = null, int $level = -1): \RecursiveIteratorIterator
    {
        $directory = new \RecursiveDirectoryIterator($sourceDirectory, \FilesystemIterator::SKIP_DOTS);
        $files = new \RecursiveCallbackFilterIterator($directory, function (\SplFileInfo $current, $key, $iterator) use ($filter) {
            if ($iterator->hasChildren()) {
                return true;
            }

            if ($current->isReadable() && !$current->isDir()) {
                return $filter ? $filter($current) : true;
            }

            return false;
        });

        $iterator = new \RecursiveIteratorIterator($files);
        $iterator->setMaxDepth($level);

        return $iterator;
    }


    public static function sortByDate(\SplFileInfo $file, string $destination)
    {
        $creationTime = (new \DateTimeImmutable())->setTimestamp($file->getCTime());

        $month = $creationTime->format('m');
        $year = $creationTime->format('Y');

        $destinationPath = $destination . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month;

        !is_dir($destinationPath) && mkdir($destinationPath, 0744, true);

        $destinationPath = $destinationPath . DIRECTORY_SEPARATOR . basename($file->getRealPath());

        copy($file->getRealPath(), $destinationPath);
    }

    public static function sortByType(\SplFileInfo $file, string $destination)
    {
        $destinationPath = $destination . DIRECTORY_SEPARATOR . $file->getExtension();

        !is_dir($destinationPath) && mkdir($destinationPath, 0744, true);

        $destinationPath = $destinationPath . DIRECTORY_SEPARATOR . basename($file->getRealPath());

        copy($file->getRealPath(), $destinationPath);
    }
}
