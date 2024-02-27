#!/usr/bin/php
<?php

use FileOrganizer\FileOrganizer;

require_once __DIR__ . '/vendor/autoload.php';

clearstatcache();

$commands = ['type', 'date', 'size'];
$options = getopt('', ['date', 'type:', 'size', 'source:', 'destination:']);

$source = $options['source'] ?? __DIR__;
$destination = $options['destination'] ?? __DIR__;

$source = substr($source, 0, 1) === '/' ? $source : __DIR__ . DIRECTORY_SEPARATOR . $source;
$destination = substr($destination, 0, 1) === '/' ? $destination : __DIR__ . DIRECTORY_SEPARATOR . $destination;

$fileOrganizer = new FileOrganizer();
$directory = $fileOrganizer->readDirectory($source);

if (array_key_exists('date', $options)) {
    foreach ($directory as $file) {
        FileOrganizer::sortByDate($file, $destination);
    }
}
