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
        return app(Client::class)->postJson($this->endpoint, $params);
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
        return app(Client::class)->postJson($this->endpoint . '/request', $params);
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
        return app(Client::class)->postJson($this->endpoint . '/status', $params);
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
        return app(Client::class)->getJson($this->endpoint . '/request/' . $requestId);
    }

    /**
     * Tekil iznin mevcut bayi izin erişimlerine, yeni bayilerin izin erişimini ekler.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/bayi-izin-yonetimi/bayi-izin-erisimi-ekleme/
     *
     * @param array $params
     * @return array|mixed
     */
    public function giveAccess(array $params)
    {
        return app(Client::class)->postJson($this->endpoint . '/retailers/access', $params);
    }

    /**
     * Birden fazla bayiye birden fazla izin için erişim verilmesini sağlar.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/bayi-izin-yonetimi/bayi-izin-erisimi-verme/
     *
     * @param array $params
     * @return array|mixed
     */
    public function giveManyAccess(array $params)
    {
        return app(Client::class)->putJson($this->endpoint . '/retailers/access', $params);
    }

    /**
     * Tekil iznin hangi bayilerle ilişkili olduğunu sorgular.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/bayi-izin-yonetimi/bayi-erisimi-sorgulama/
     *
     * @param array $params
     * @param int|null $offset
     * @param int|null $limit
     * @return array|mixed
     */
    public function accessList(array $params, int $offset = null, int $limit = null)
    {
        $query = '';

        if ($offset && $limit) {
            $query = '?' . http_build_query([
                    'offset' => $offset,
                    'limit' => $limit,
                ]);
        }

        return app(Client::class)->postJson($this->endpoint . '/retailers/access/list' . $query, $params);
    }

    /**
     * Birden fazla bayinin birden fazla izin için erişimini siler.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/bayi-izin-yonetimi/coklu-bayi-erisimi-silme/
     *
     * @param array $params
     * @return array|mixed
     */
    public function deleteAccess(array $params)
    {
        return app(Client::class)->postJson($this->endpoint . '/retailer/access/remove', $params);
    }

    /**
     * Tüm bayilerin birden fazla izin için erişimini siler.
     *
     * Doc: https://dev.iys.org.tr/api-metotlar/bayi-izin-yonetimi/tum-bayilerin-izin-erisimlerini-silme/
     *
     * @param array $params
     * @return array|mixed
     */
    public function deleteAllAccess(array $params)
    {
        return app(Client::class)->postJson($this->endpoint . '/retailer/access/remove/all', $params);
    }
}
