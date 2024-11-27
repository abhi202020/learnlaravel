<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class LoginErply extends Command
{
    protected $signature = 'erply:login';
    protected $description = 'Authenticate with the Erply API and retrieve a session key';

    public function handle()
    {
        
        $clientCode = env('ERPLY_CLIENT_CODE');
        $username = env('ERPLY_USERNAME');
        $password = env('ERPLY_PASSWORD');

    
        if (!$clientCode || !$username || !$password) {
            $this->error('Missing required Erply credentials in the environment file.');
            return 1; 
        }

        // Sending the request to Erply API
        $response = Http::asForm()->post("https://{$clientCode}.erply.com/api/", [
            'request' => 'verifyUser',
            'clientCode' => $clientCode,
            'username' => $username,
            'password' => $password,
            'sendContentType' => 1,
        ]);

        // Handle API response
        if ($response->ok() && $response->json('status.responseStatus') === 'ok') {
            $sessionKey = $response->json('records.0.sessionKey');
            $this->info('Login successful!');
            $this->info("Session Key: {$sessionKey}");
        } else {
            $errorCode = $response->json('status.errorCode');
            $errorMessage = $response->json('status.errorMessage');
            $this->error("Login failed. Error Code: {$errorCode}, Message: {$errorMessage}");
        }

        return 0; 
    }
}
