<?php

use FileOrganizer\File;
use FileOrganizer\FileOrganizer;

require_once __DIR__ . '/vendor/autoload.php';

clearstatcache();

$sourceDirectory = __DIR__ . DIRECTORY_SEPARATOR . '/teste';
$destinationDirectory = __DIR__ . DIRECTORY_SEPARATOR . '/destino';

function sortByDate(File $file, string $destination)
{
    $month = $file->getCreateDate()->format('m');
    $year = $file->getCreateDate()->format('Y');

    $destinationPath = $destination . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month;

    $file->moveTo($destinationPath);
}


$fileOrganizer = new FileOrganizer();
$fileOrganizer->organize($sourceDirectory, $destinationDirectory, 'sortByDate');
