<?php
namespace App\Services;

use Twilio\Rest\Client;

class TwilioWhatsAppService
{
    protected $twilio;
    protected $from;

    public function __construct()
    {
        $sid   = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $this->from = config('services.twilio.from');

        if (!$sid || !$token) {
            throw new \Exception("Twilio SID or Auth Token is missing from config.");
        }

        $this->twilio = new Client($sid, $token);
    }

    public function sendMessage(string $to, string $message)
    {
        return $this->twilio->messages->create(
            "whatsapp:$to",
            [
                "from" => $this->from,
                "body" => $message
            ]
        );
    }

    public function sendMessageButton(string $to, string $templateSid, array $variables)
    {
        return $this->twilio->messages->create(
            "whatsapp:$to",
            [
                "from" => $this->from,
                "contentSid" => $templateSid,
                "contentVariables" => json_encode($variables),
            ]
        );
    }
}
