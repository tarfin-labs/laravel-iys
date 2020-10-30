<?php

namespace TarfinLabs\Iys\Tests;

use Faker\Generator;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;
use TarfinLabs\Iys\IysServiceProvider;

abstract class TestCase extends Orchestra
{
    protected $config;
    protected Generator $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->config = config('laravel-iys');

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
