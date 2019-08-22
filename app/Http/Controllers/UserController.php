<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{
    protected function check_recaptcha(Request $request)
    {
        if ($request->checkbox) return;

        $response = (new Client)->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => config('recaptcha.secret'),
                'response' => $request->recaptcha_token
            ],
        ]);
        $response_arr = json_decode($response->getBody(), true);

        if ($response_arr['success'])
            return response()->json($response_arr, 200);

        return response()->json($response_arr, 405);
    }
}
