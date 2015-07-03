#!/usr/bin/env php
<?php

$user = 'civix';

if (run("id -u $user") > 0) {
    `useradd -d $dir -m $user`;
}

`sudo supervisorctl stop {$user}_push_queue`;

function run($cmd, &$output = null)
{
    $descriptorspec = [
        ['pipe', 'r'],
        ['pipe', 'w'],
        ['pipe', 'w'],
    ];

    $process = proc_open($cmd, $descriptorspec, $pipes);
    fclose($pipes[0]);
    $output = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    fclose($pipes[2]);

    return proc_close($process);
}