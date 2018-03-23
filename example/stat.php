<?php

require_once 'common.php';

$res = $client->stat($accountId);
print_r($res);
echo PHP_EOL;
