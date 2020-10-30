<?php

namespace TarfinLabs\Iys;

class Iys
{
    public $config;

    public function __construct()
    {
        $this->config = config('laravel-iys');
    }

    /**
     * Marka işlemleri.
     *
     * @return Brand
     */
    public function brands()
    {
        return new Brand();
    }

    /**
     * İzin işlemleri.
     *
     * @return Consent
     */
    public function consents()
    {
        return new Consent();
    }
}
