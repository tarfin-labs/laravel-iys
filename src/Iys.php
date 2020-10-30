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
     * Hizmet sağlayıcı hesabınızın altında bulunan markalarınızını listeler.
     *
     * @return array|mixed
     */
    public function brands()
    {
        $client = new Client();

        return $client->getJson("/sps/{$this->config['iys_code']}/brands");
    }
}
