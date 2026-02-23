<?php
namespace App\Service;

use Twilio\Rest\Client;

class TwilioService
{
    private $accountSid;
    private $authToken;
    private $twilioPhoneNumber;

    public function __construct($accountSid, $authToken, $twilioPhoneNumber)
    {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->twilioPhoneNumber = $twilioPhoneNumber;
    }

    public function sendSMS($to, $messageBody)
    {
        $twilio = new Client($this->accountSid, $this->authToken);

        $message = $twilio->messages
            ->create($to, // To
                [
                    "from" => $this->twilioPhoneNumber,
                    "body" => $messageBody
                ]
            );

        return $message->sid;
    }
}
