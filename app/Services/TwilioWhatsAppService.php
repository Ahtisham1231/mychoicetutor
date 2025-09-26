<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioWhatsAppService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendMessage(string $to, string $message)
    {
        return $this->twilio->messages->create(
            "whatsapp:$to",
            [
                "from" => env('TWILIO_WHATSAPP_FROM'),
                "body" => $message
            ]
        );
    }
   public function sendMessageButton(string $to, string $templateSid, array $variables)
    {
        return $this->twilio->messages->create(
            "whatsapp:$to",
            [
                "from" => env('TWILIO_WHATSAPP_FROM'),
                "contentSid" => $templateSid,
                "contentVariables" => json_encode($variables),
            ]
        );
    }
}
