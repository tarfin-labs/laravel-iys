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

    /**
     * Hizmet sağlayıcı markasının altındaki tüm bayileri listeler.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/bayi-yonetimi/bayi-sorgulama-listeleme/
     *
     * @param int|null $offset
     * @param int|null $limit
     * @return array|mixed
     */
    public function all(int $offset = null, int $limit = null)
    {
        $client = new Client();

        $params = [];

        if ($offset && $limit) {
            $params = [
                'offset' => $offset,
                'limit' => $limit,
            ];
        }

        return $client->getJson($this->endpoint, $params);
    }

    /**
     * İys numarası verilen bayinin bilgilerini getirir.
     *
     * @param int $retailerCode
     * @return array|mixed
     */
    public function find(int $retailerCode)
    {
        $client = new Client();

        return $client->getJson($this->endpoint . '/' . $retailerCode);
    }
}
