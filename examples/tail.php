#!/usr/bin/env php
<?php

/**
 * This example can be used to logfile processing and basically wraps the tail
 * command.
 *
 * The benefit of using this, is that it allows you to tail multiple logs at
 * the same time
 *
 * To stop this application, hit CTRL-C
 */
if ($argc < 2) {
    echo "Usage: " . $argv[0] . " filename\n";
    exit(1);
}

require __DIR__ . '/../vendor/autoload.php';

$loop = new Sabre\Event\Loop();

$tail = popen('tail -fn0 ' . escapeshellarg($argv[1]), 'r');

$loop->addReadStream($tail, function() use ($tail) {

    echo fread($tail, 4096);

});

$loop->run();
