<?php

require_once 'common.php';

//print_r($client);


$messageId = getenv('ZORGMAIL_SEND_MESSAGE_ID');
$recipient = getenv('ZORGMAIL_SEND_RECIPIENT');
$subject = getenv('ZORGMAIL_SEND_SUBJECT');
$content = getenv('ZORGMAIL_SEND_CONTENT');
$contentType = getenv('ZORGMAIL_SEND_CONTENT_TYPE');
if ($content[0]=='@') {
    $content = file_get_contents(substr($content, 1));
}

$client->send($messageId, $recipient, $subject, $content, $contentType);
