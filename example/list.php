<?php

require_once 'common.php';

$ids = $client->listMessages();
print_r($ids);
