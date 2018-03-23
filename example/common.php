<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

$username = getenv('ZORGMAIL_USERNAME');
$password = getenv('ZORGMAIL_PASSWORD');
$accountId = getenv('ZORGMAIL_ACCOUNT_ID');

if (!$username || !$password || !$accountId) {
    exit("Please setup the ZORGMAIL_USERNAME, ZORGMAIL_PASSWORD and ZORGMAIL_ACCOUNT_ID environment variables\n");
}

$client = \Zorgmail\Soap\Client::fromAspCredentials($username, $password, $accountId);
