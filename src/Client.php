<?php

namespace Zorgmail\Soap;

use SoapClient;

class Client
{
    protected $soapClient;
    protected static $wsdl = __DIR__ . '/../ems-mailwebservice-inline.wsdl';
    protected $accountId;

    private function __construct()
    {

    }

    public static function fromAspCredentials($username, $password, $accountId)
    {
        $client = self::fromAccountCredentials($username, $password);
        $client->accountId = $accountId;
        return $client;
    }

    public static function fromAccountCredentials($username, $password)
    {
        $client = new self;

        $options = [
            'login' => $username,
            'password' => $password,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS|SOAP_WAIT_ONE_WAY_CALLS
        ];

        $client->soapClient = new SoapClient(self::$wsdl, $options);
        $client->accountId = $username;
        return $client;
    }

    public function getSoapClient()
    {
        return $this->soapClient;
    }

    public function listMessages()
    {
        $res = $this->soapClient->List(['accountId' => $this->accountId]);
        if (!isset($res->uniqueIds)) {
            return [];
        }
        return $res->uniqueIds;
    }

    public function stat()
    {
        $res = $this->soapClient->Stat(['accountId' => $this->accountId]);
        return $res->count;
    }

    public function retrieve($uniqueId)
    {
        $res = (array)$this->soapClient->Retrieve(['uniqueId'=>$uniqueId]);
        return $res;
    }

    /**
     * Delete is always successfull
     *
     * If the uniqueId exists, it will be deleted
     * otherwise it will perform a Noop and return.
     */
    public function delete($uniqueId)
    {
        $this->soapClient->Delete(['uniqueId'=>$uniqueId]);
        return true;
    }

    /**
     * Sends a new message
     */
    public function send($messageId, $recipient, $subject, $content, $contentType = 'text/plain')
    {
        $arguments = [
            'messageId' => $messageId,
            'sender' => $this->accountId . '@lms.lifeline.nl',
            'recipient' => $recipient,
            'subject' => $subject,
            'content' => $content,
            'contentType' => $contentType,
        ];
        $this->soapClient->Send($arguments);
    }
}
