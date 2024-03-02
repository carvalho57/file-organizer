#!/usr/bin/env php
<?php

use FileOrganizer\FileOrganizer;

require_once __DIR__ . '/vendor/autoload.php';

(static function (): void {
    if (file_exists($autoload = __DIR__ . '/vendor/autoload.php')) {
        include_once $autoload;

        return;
    }

    throw new \RuntimeException('Não foi possível encontrar o Composer autoloader.');
})();

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
} else {
    $help = <<<HELP
         
      ___  _ __ __ _  __ _ _ __ (_)_______ 
     / _ \| '__/ _` |/ _` | '_ \| |_  / _ \
    | (_) | | | (_| | (_| | | | | |/ /  __/
     \___/|_|  \__, |\__,_|_| |_|_/___\___|
               |___/                       
               
    Organize
        Organiza os arquivos do diretório

    Usage:
        comando [opções] [argumentos]

    Options:
        --date       Organiza os arquivos recursivamente por data
        --type       Organiza os arquivos pela tipo do arquivo (extensão)

    Arguments:
        --source     Diretorio que será analizado
        --destination Diretório em que os arquivos serão encaminhados apos processados

    Examples:
    organizer --date
    organizer --type
    organizer --type="mp3,mp4,jpg"
    organizer --type="mp3,mp4,jpg" --source origem --destination destino
HELP;

    echo $help . PHP_EOL;
}
