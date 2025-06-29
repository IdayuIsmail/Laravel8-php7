<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class KeycloakController extends Controller
{
    public function redirectToKeycloak()
    {
        return redirect(env('KEYCLOAK_BASE_URL') . "/realms/" . env('KEYCLOAK_REALM') . "/protocol/openid-connect/auth?" . http_build_query([
            'client_id'     => env('KEYCLOAK_CLIENT_ID'),
            'redirect_uri'  => env('KEYCLOAK_REDIRECT_URI'),
            'response_type' => 'code',
            'scope'         => 'openid profile email',
        ]));
    }

    public function handleKeycloakCallback(Request $request)
    {
        try {
            $tokenResponse = Http::asForm()->post(env('KEYCLOAK_BASE_URL') . "/realms/" . env('KEYCLOAK_REALM') . "/protocol/openid-connect/token", [
                'client_id'     => env('KEYCLOAK_CLIENT_ID'),
                'client_secret' => env('KEYCLOAK_CLIENT_SECRET'),
                'redirect_uri'  => env('KEYCLOAK_REDIRECT_URI'),
                'grant_type'    => 'authorization_code',
                'code'          => $request->code,
            ])->json();
            if (!isset($tokenResponse['access_token'])) return redirect('/login')->withErrors('Login failed.');
            session(['keycloak_id_token' => $tokenResponse['id_token']]);
            $userInfo = Http::withToken($tokenResponse['access_token'])->get(env('KEYCLOAK_BASE_URL') . "/realms/" . env('KEYCLOAK_REALM') . "/protocol/openid-connect/userinfo")->json();
            if (!$userInfo || !isset($userInfo['nric'])) return redirect('/login')->withErrors('User data missing.');
            session([
                'user_name'  => $userInfo['nama'],
                'user_nric'  => $userInfo['nric'],
            ]);
            return redirect('/dashboard')->with('success', 'Login successful');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Login error: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        $idToken = session('keycloak_id_token');
        $logoutUrl = env('KEYCLOAK_BASE_URL') . "/realms/" . env('KEYCLOAK_REALM') . "/protocol/openid-connect/logout?" . http_build_query([
            'id_token_hint'             => $idToken,
            'post_logout_redirect_uri' => url('/'),
            'client_id'                 => env('KEYCLOAK_CLIENT_ID'),
        ]);
        return redirect($logoutUrl);
    }
}
