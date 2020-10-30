<?php

namespace TarfinLabs\Iys\Tests\Responses;

use Illuminate\Support\Facades\Http;

class AuthResponse extends BaseResponse
{
    public array $oauthResponse = [
        'accessToken'        => 'xxxxxx',
        'refreshToken'       => 'yyyyy',
        'expiresIn'          => 7200,
        'refresh_expires_in' => 14400,
        'tokenType'          => 'bearer',
    ];

    public function get(): array
    {
        $oauthUrl = $this->config['url'] . '/oauth2/token';

        return [
            $oauthUrl => Http::response($this->oauthResponse, 200),
        ];
    }
}
