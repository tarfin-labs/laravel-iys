<?php

namespace TarfinLabs\Iys\Tests;

use Illuminate\Support\Facades\Http;
use TarfinLabs\Iys\Iys;

class IysTest extends TestCase
{
    /** @test */
    public function get_brands()
    {
        $iys = new Iys();
        $response = $iys->brands();
        $config = config('laravel-iys');

        Http::assertSent(function ($request) use ($config) {
            return $request->url() == $config['url'] . "/sps/{$config['iys_code']}/brands";
        });
    }
}
