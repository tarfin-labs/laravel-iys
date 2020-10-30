<?php

namespace TarfinLabs\Iys\Tests;

use Illuminate\Support\Facades\Http;
use TarfinLabs\Iys\Client;

class AuthTest extends TestCase
{
    /** @test */
    public function user_can_authenticate()
    {
        $client = new Client();
        $this->assertSame('xxxxxx', $client->token);
        $this->assertSame('yyyyy', $client->refreshToken);
    }
}
