<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MpesaService
{
    protected $config;

    public function __construct()
    {
        $this->config = config('mpesa');
    }

    protected function getSessionToken()
    {
        return Cache::remember('mpesa_session', 25*60, function () {
            $response = Http::withHeaders([
                'Origin' => $this->config['origin'],
            ])->withOptions(['verify' => false])
              ->get($this->config['urls'][$this->config['env']]['session'], [
                  'apikey' => $this->config['api_key'],
              ]);

            if ($response->failed()) {
                throw new \Exception("Failed to get M-Pesa session: " . $response->body());
            }

            return $response->json()['output_SessionID'] ?? null;
        });
    }

    public function c2bPayment(array $data)
    {
        $session = $this->getSessionToken();

        $payload = [
            'input_Amount' => $data['amount'],
            'input_Country' => $this->config['country'],
            'input_Currency' => $this->config['currency'],
            'input_CustomerMSISDN' => $data['msisdn'],
            'input_ServiceProviderCode' => $this->config['service_provider_code'],
            'input_ThirdPartyConversationID' => uniqid('conv_'),
            'input_TransactionReference' => $data['reference'],
            'input_PurchasedItemsDesc' => $data['description'] ?? 'Payment',
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$session}",
            'Origin' => $this->config['origin'],
            'Content-Type' => 'application/json',
        ])->post($this->config['urls'][$this->config['env']]['c2b'], $payload);

        return $response->json();
    }

    public function checkTransactionStatus(string $conversationId)
    {
        $session = $this->getSessionToken();

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$session}",
            'Origin' => $this->config['origin'],
            'Content-Type' => 'application/json',
        ])->post($this->config['urls'][$this->config['env']]['status'], [
            'input_OriginalConversationID' => $conversationId,
        ]);

        return $response->json();
    }
}
