<?php

namespace TarfinLabs\Iys;

class Consent
{
    protected $endpoint;
    protected $config;

    public function __construct()
    {
        $this->config = config('laravel-iys');
        $this->endpoint = "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/consents";
    }

    /**
     * Alıcıdan alınmış izinleri tekil olarak İYS'ye yükler.
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
