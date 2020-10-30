<?php

namespace TarfinLabs\Iys\Tests;

use Faker\Generator;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;
use TarfinLabs\Iys\IysServiceProvider;

abstract class TestCase extends Orchestra
{
    protected Generator $faker;

    public function setUp(): void
    {
        parent::setUp();

        $oauthUrl = config('laravel-iys.url') . '/oauth2/token';

        Http::fake(Response::all());
    }

    protected function getPackageProviders($app): array
    {
        return [
            IysServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);
    }
}
