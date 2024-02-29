#!/usr/bin/php
<?php

use FileOrganizer\FileOrganizer;

require_once __DIR__ . '/vendor/autoload.php';

clearstatcache();

$commands = ['type', 'date', 'size'];
$options = getopt('t', ['date', 'type::', 'size', 'source:', 'destination:']);

$source = $options['source'] ?? getcwd();
$destination = $options['destination'] ?? getcwd();

$source = substr($source, 0, 1) === '/' ? $source : getcwd() . DIRECTORY_SEPARATOR . $source;
$destination = substr($destination, 0, 1) === '/' ? $destination : getcwd() . DIRECTORY_SEPARATOR . $destination;

$fileOrganizer = new FileOrganizer();

if (array_key_exists('date', $options)) {
    $directory = $fileOrganizer->readDirectory($source);
    foreach ($directory as $file) {
        FileOrganizer::sortByDate($file, $destination);
    }
} elseif (array_key_exists('type', $options)) {
    $selectedExtensions = $options['type'] !== false ? array_map('trim', explode(',', $options['type'])) : [];

    $directory = $fileOrganizer->readDirectory($source, function (SplFileInfo $file) use ($selectedExtensions) {
        if (empty($selectedExtensions)) {
            return true;
        }

        if (in_array($file->getExtension(), $selectedExtensions)) {
            return true;
        }

        return false;
    });

    foreach ($directory as $file) {
        FileOrganizer::sortByType($file, $destination);
    }
}
