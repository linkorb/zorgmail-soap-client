<?php

require_once 'common.php';

$uniqueId = trim($argv[1]);
if (!$uniqueId) {
    exit($uniqueId);
}

$res = $client->retrieve($uniqueId);
print_r($res);
