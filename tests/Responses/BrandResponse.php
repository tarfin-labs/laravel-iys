<?php

namespace TarfinLabs\Iys\Tests\Responses;

use Illuminate\Support\Facades\Http;

class BrandResponse extends BaseResponse
{
    public array $brandResponse = [
        [
            "brandCode" => 545454,
            "stats"     => [
                "consents"  => [
                    "approval"  => 22,
                    "rejection" => 0,
                    "total"     => 22
                ],
                "retailers" => [
                    "total" => 4
                ]
            ],
            "name"      => "test Marka 1",
            "master"    => true
        ],
        [
            "brandCode" => 545455,
            "stats"     => [
                "consents"  => [
                    "approval"  => 0,
                    "rejection" => 0,
                    "total"     => 0
                ],
                "retailers" => [
                    "total" => 0
                ]
            ],
            "name"      => "test Alt Marka 2",
            "master"    => false
        ]
    ];

    public function get(): array
    {
        $brandUrl = $this->config['url'] . "/sps/{$this->config['iys_code']}/brands";

        return [
            $brandUrl => Http::response($this->brandResponse, 200),
        ];
    }
}
