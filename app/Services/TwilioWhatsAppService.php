<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioWhatsAppService
{
    protected $twilio;
    protected $from;

    public function __construct()
    {
        // don't throw immediately — just store values
        $sid   = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $this->from = config('services.twilio.from');

        if ($sid && $token) {
            $this->twilio = new Client($sid, $token);
        }
    }

    public function sendMessage(string $to, string $message)
    {
        if (!$this->twilio) {
            throw new \Exception("Twilio client not initialized. Check config.");
        }

        return $this->twilio->messages->create(
            "whatsapp:$to",
            [
                "from" => $this->from,
                "body" => $message
            ]
        );
    }
}
