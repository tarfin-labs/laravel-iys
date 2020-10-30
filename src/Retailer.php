<?php

namespace TarfinLabs\Iys;

class Retailer
{
    protected $endpoint;
    protected $config;

    public function __construct()
    {
        $this->config = config('laravel-iys');
        $this->endpoint = "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/retailers";
    }

    /**
     * Hizmet sağlayıcı markasının altına bayi ekler.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/bayi-yonetimi/bayi-ekleme/
     *
     * @param array $params
     * @return array|mixed
     */
    public function create(array $params)
    {
        $client = new Client();

        return $client->postJson($this->endpoint, $params);
    }
}
