<?php

namespace App\Services\Investment;

use Illuminate\Support\Facades\Http;

class InfobipWhatsAppService
{
    public function sendTemplateMessage(string $to, string $templateName, array $variables = [])
    {
        $url = config('services.infobip.base_url') . '/whatsapp/1/message/template';

        $body = [
            "to" => $to,
            "template" => [
                "name" => $templateName,
                "language" => [
                    "code" => "en_US"
                ],
                "components" => [
                    [
                        "type" => "body",
                        "parameters" => array_map(fn($value) => ["type" => "text", "text" => $value], $variables)
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'App ' . config('services.infobip.api_key'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url, $body);

        return $response->json();
    }

    public function sendTextMessage(string $to, string $text)
    {
        $url = config('services.infobip.base_url') . '/messages';

        $payload = [
            "messages" => [
                [
                    "channel" => "WHATSAPP",
                    "sender" => null,
                    "destinations" => [
                        ["to" => $to]
                    ],
                    "content" => [
                        "body" => [
                            "type" => "TEXT",
                            "text" => $text
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'App ' . config('services.infobip.api_key'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url, $payload);

        return $response->json();
    }
}
