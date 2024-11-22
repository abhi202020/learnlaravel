<?php

namespace App\Http\Controllers;

use App\Services\ErplyService;
use Illuminate\Http\Request;

class ErplyController extends Controller
{
    protected $erplyService;

    public function __construct(ErplyService $erplyService)
    {
        $this->erplyService = $erplyService;
    }

    public function authenticate(Request $request)
    {
        try {
            // Call the ErplyService to authenticate and get the session key
            $sessionKey = $this->erplyService->authenticate();

            // Return success response with the session key
            return response()->json([
                'message' => 'Successfully authenticated with Erply',
                'sessionKey' => $sessionKey
            ]);
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
