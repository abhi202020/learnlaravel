<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ErplyService
{
    protected $accountNumber;
    protected $username;
    protected $password;
    protected $apiUrl;

    public function __construct()
    {
        // Set these values from your .env or config
        $this->accountNumber = env('ERPLY_ACCOUNT_NUMBER'); // Store this in .env
        $this->username = env('ERPLY_USERNAME');  // Store this in .env
        $this->password = env('ERPLY_PASSWORD');  // Store this in .env
        $this->apiUrl = "https://{$this->accountNumber}.erply.com/api/";
    }

    public function authenticate()
    {
        $response = Http::asForm()->post($this->apiUrl, [
            'request' => 'verifyUser',
            'clientCode' => $this->accountNumber,
            'sendContentType' => 1,
            'username' => $this->username,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            // Extract the sessionKey from the response
            $data = $response->json();
            if (isset($data['records'][0]['sessionKey'])) {
                return $data['records'][0]['sessionKey'];
            }
        }

        return null;
    }
}
