<?php

namespace TarfinLabs\Iys\Tests;

use TarfinLabs\Iys\Tests\Responses\AuthResponse;
use TarfinLabs\Iys\Tests\Responses\BrandResponse;

class Response
{
    public static $response = [];

    public static function all()
    {
        $authResponse = new AuthResponse();
        $brandResponse = new BrandResponse();

        return array_merge(
            self::$response,
            $authResponse->get(),
            $brandResponse->get()
        );
    }
}
