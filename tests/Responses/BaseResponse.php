<?php

namespace TarfinLabs\Iys\Tests\Responses;

abstract class BaseResponse
{
    public $config;

    public function __construct()
    {
        $this->config = config('laravel-iys');
    }

    abstract public function get(): array;
}
