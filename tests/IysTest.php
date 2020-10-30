<?php

namespace TarfinLabs\Iys\Tests;

use Illuminate\Support\Facades\Http;
use TarfinLabs\Iys\Iys;

class IysTest extends TestCase
{
    /** @test */
    public function user_can_get_brands()
    {
        $iys = new Iys();
        $response = $iys->brands()->all();

        Http::assertSent(function ($request) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands";
        });
    }

    /** @test */
    public function user_can_create_consent()
    {
        Http::fake();

        $iys = new Iys();
        $response = $iys->consents()->create([
            'consentDate'    => '2018-02-10 09:30:00',
            'source'         => 'HS_CAGRI_MERKEZI',
            'recipient'      => '+905813334455',
            'recipientType'  => 'BIREYSEL',
            'status'         => 'ONAY',
            'type'           => 'ARAMA',
            'retailerCode '  => 11223344,
            'retailerAccess' => [
                22233344,
                44222419,
                13239987
            ]
        ]);

        Http::assertSent(function ($request) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/consents";
        });
    }

    /** @test */
    public function user_can_create_many_consent()
    {
        Http::fake();

        $iys = new Iys();
        $response = $iys->consents()->createMany([
            [
                'consentDate'    => '2018-02-10 09:30:00',
                'source'         => 'HS_MESAJ',
                'recipient'      => '+905813334455',
                'recipientType'  => 'BIREYSEL',
                'status'         => 'RET',
                'type'           => 'ARAMA',
                'retailerCode '  => 11223344,
                'retailerAccess' => [
                    22233344,
                    44222419,
                    13239987
                ]
            ],
            [
                'consentDate'    => '2018-02-10 09:40:00',
                'source'         => 'HS_WEB',
                'recipient'      => 'ornek@adiniz.com',
                'recipientType'  => 'BIREYSEL',
                'status'         => 'ONAY',
                'type'           => 'EPOSTA',
                'retailerCode '  => 11223344,
                'retailerAccess' => [
                    22233344,
                    44222419,
                    13239987
                ]
            ],
        ]);

        Http::assertSent(function ($request) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/consents/request";
        });
    }

    /** @test */
    public function user_can_get_status_of_consent()
    {
        Http::fake();

        $iys = new Iys();
        $response = $iys->consents()->status([
            'recipient'     => '+905813334455',
            'recipientType' => 'BIREYSEL',
            'type'          => 'MESAJ',
        ]);

        Http::assertSent(function ($request) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/consents/status";
        });
    }

    /** @test */
    public function user_can_get_statuses_of_create_many_consent_request()
    {
        Http::fake();

        $requestId = '73b75030-3a92-4f1e-b247-b0509dbadbfc';

        $iys = new Iys();
        $response = $iys->consents()->statuses($requestId);

        Http::assertSent(function ($request) use ($requestId) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/consents/request/{$requestId}";
        });
    }

    /** @test */
    public function user_can_create_a_retailer()
    {
        Http::fake();

        $iys = new Iys();
        $response = $iys->retailers()->create([
            'tckn'   => 42790000000,
            'name'   => 'Adım Soyadım',
            'city'   => [
                'name' => 'İstanbul',
                'code' => '34'
            ],
            'town'   => [
                'name' => 'Şişli',
                'code' => '05'
            ],
            'title'  => 'ADIM SOYADIM TİCARET',
            'mersis' => '0015001526400496',
            'alias'  => 'ŞİŞLİ MAĞAZASI',
            'mobile' => '+905357990000'
        ]);

        Http::assertSent(function ($request) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/retailers";
        });
    }

    /** @test */
    public function user_can_get_all_retailers()
    {
        Http::fake();

        $iys = new Iys();
        $response = $iys->retailers()->all();

        Http::assertSent(function ($request) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/retailers";
        });
    }

    /** @test */
    public function user_can_get_all_retailers_with_pagination_options()
    {
        Http::fake();

        $iys = new Iys();
        $response = $iys->retailers()->all(100, 10);

        $query = http_build_query([
            'offset' => 100,
            'limit'  => 10,
        ]);

        Http::assertSent(function ($request) use ($query) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/retailers?{$query}";
        });
    }

    /** @test */
    public function user_can_get_a_retailer()
    {
        Http::fake();

        $retailerCode = 66438915;

        $iys = new Iys();
        $response = $iys->retailers()->find($retailerCode);

        Http::assertSent(function ($request) use ($retailerCode) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/retailers/{$retailerCode}";
        });
    }

    /** @test */
    public function user_can_delete_a_retailer()
    {
        Http::fake();

        $retailerCode = 66438915;

        $iys = new Iys();
        $response = $iys->retailers()->delete($retailerCode);

        Http::assertSent(function ($request) use ($retailerCode) {
            return $request->url() == $this->config['url'] . "/sps/{$this->config['iys_code']}/brands/{$this->config['brand_code']}/retailers/{$retailerCode}";
        });
    }
}
