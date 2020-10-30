<?php

namespace TarfinLabs\Iys;

class Brand
{
    protected $endpoint;
    protected $config;

    public function __construct()
    {
        $this->config = config('laravel-iys');
        $this->endpoint = "/sps/{$this->config['iys_code']}/brands";
    }

    /**
     * Hizmet sağlayıcı hesabınızın altında bulunan markalarınızını listeler.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/marka-yonetimi/marka-listeleme/
     *
     * @return array|mixed
     */
    public function all()
    {
        $client = new Client();

        return $client->getJson($this->endpoint);
    }
}
