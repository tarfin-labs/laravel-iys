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
    public function user_can_add_consent()
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
}
