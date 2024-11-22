<?php

namespace app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class LoginErply extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'erply:login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Authenticate with the Erply API and retrieve a session key';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Define credentials
        $clientCode = '466020';
        $username = 'abhishek';
        $password = 'Ab123456';

        // Make POST request to Erply API
        $response = Http::asForm()->post("https://{$clientCode}.erply.com/api/", [
            'request' => 'verifyUser',
            'clientCode' => $clientCode,
            'username' => $username,
            'password' => $password,
            'sendContentType' => 1,
        ]);

        // Handle API response
        if ($response->ok() && $response->json('status.responseStatus') === 'ok') {
            $this->info('Login successful!');
            $sessionKey = $response->json('records.0.sessionKey');
            $this->info("Session Key: {$sessionKey}");
        } else {
            $this->error('Login failed. Please check your credentials or API.');
        }
    }
}
