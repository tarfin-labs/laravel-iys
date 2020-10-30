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

    /**
     * Alıcıdan alınmış izinleri tekil olarak İYS'ye yükler.
     *
     * @param array $params
     */
    public function addConsent(array $params)
    {
        $client = new Client();

        return $client->postJson("/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/consents", $params);
    }
}
