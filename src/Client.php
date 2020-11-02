<?php

namespace TarfinLabs\Iys;

use Illuminate\Support\Facades\Http;

class Client
{
    public $url;
    public $token;
    public $refreshToken;

    public function __construct()
    {
        $config = config('laravel-iys');

        $this->url = $config['url'];

        $this->authenticate();
    }

    protected function authenticate()
    {
        if (!$this->token) {
            $response = $this->getToken();

            $this->token = $response['accessToken'];
            $this->refreshToken = $response['refreshToken'];
        }
    }

    protected function getToken()
    {
        $response = Http::post($this->url . '/oauth2/token', [
            'username'   => config('laravel-iys.username'),
            'password'   => config('laravel-iys.password'),
            'grant_type' => 'password',
        ]);

        $response->throw();

        return $response;
    }

    protected function refreshToken()
    {
        $response = Http::post($this->url . '/oauth/token', [
            'refreshToken'   => $this->refreshToken,
        ]);

        $response->throw();
    }

    public function postJson($endpoint, $params)
    {
        $response = Http::withToken($this->token)->post($this->url . $endpoint, $params);

        return $response->throw()->json();
    }

    public function putJson($endpoint, $params)
    {
        $response = Http::withToken($this->token)->put($this->url . $endpoint, $params);

        return $response->throw()->json();
    }

    public function getJson($endpoint, $params = null)
    {
        $response = Http::withToken($this->token)->get($this->url . $endpoint, $params);

        return $response->throw()->json();
    }

    public function deleteJson($endpoint, $params = null)
    {
        $response = Http::withToken($this->token)->delete($this->url . $endpoint, $params);

        return $response->throw()->json();
    }
}
