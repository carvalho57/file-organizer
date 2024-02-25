<?php

namespace FileOrganizer;

use Exception;

class FileOrganizer
{
    public function organize(string $sourceDirectory, string $destinationDirectory, callable $callback): void
    {
        if (!is_dir($sourceDirectory) || !is_readable($sourceDirectory) || !is_writeable($sourceDirectory)) {
            throw new Exception('Problema com o diretório de origem');
        }

        !is_dir($destinationDirectory) && mkdir($destinationDirectory, 0744, true);

        $directory = new \RecursiveDirectoryIterator($sourceDirectory, \FilesystemIterator::SKIP_DOTS);
        $files = new \RecursiveCallbackFilterIterator($directory, function (\SplFileInfo $current, $key, $iterator) {
            if ($iterator->hasChildren()) {
                return true;
            }

            if ($current->isReadable() && !$current->isDir()) {
                return true;
            }

            return false;
        });

        $iterator = new \RecursiveIteratorIterator($files);
        // $iterator->setMaxDepth(1);

        foreach ($iterator as $file) {
            $currentFile = new File($file);

            $callback($currentFile, $destinationDirectory);
        }
    }
}
