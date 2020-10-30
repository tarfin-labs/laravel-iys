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
     * Doc: https://dev.iys.org.tr/api-metotlar/izin-yonetimi/tekil-izin-ekleme/
     *
     * @param array $params
     * @return array|mixed
     */
    public function create(array $params)
    {
        $client = new Client();

        return $client->postJson($this->endpoint, $params);
    }

    /**
     * Alıcıdan alınmış izinleri yığın olarak İYS'ye yükler.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/izin-yonetimi/asenkron-coklu-izin-ekleme/
     *
     * @param array $params
     * @return array|mixed
     */
    public function createMany(array $params)
    {
        $client = new Client();

        return $client->postJson($this->endpoint . '/request', $params);
    }

    /**
     * Hizmet sağlayıcıların İYS'de kayıtlı olan izinlerini tekil olarak listelemelerini sağlar.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/izin-yonetimi/tekil-izin-durumu-sorgulama/
     *
     * @param array $params
     * @return array|mixed
     */
    public function status(array $params)
    {
        $client = new Client();

        return $client->postJson($this->endpoint . '/status', $params);
    }

    /**
     * Asenkron çoklu izin ekleme işlemi sonunda dönen işlem sorgulama bilgisiyle
     * izin kayıt isteklerinin sonuçlarını sorgular.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/izin-yonetimi/coklu-izin-ekleme-istegi-sorgulama/
     *
     * @param string $requestId
     * @return array|mixed
     */
    public function statuses(string $requestId)
    {
        $client = new Client();

        return $client->getJson($this->endpoint . '/request/' . $requestId);
    }
}
