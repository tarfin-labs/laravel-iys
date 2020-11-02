# Laravel Iys

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tarfin-labs/laravel-iys.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/laravel-iys)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/tarfin-labs/laravel-iys/tests?label=tests)
[![Quality Score](https://img.shields.io/scrutinizer/g/tarfin-labs/laravel-iys.svg?style=flat-square)](https://scrutinizer-ci.com/g/tarfin-labs/laravel-iys)
[![Total Downloads](https://img.shields.io/packagist/dt/tarfin-labs/laravel-iys.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/laravel-iys)


Laravel İleti Yönetim Sistemi (IYS) entegrasyonu.

## Kurulum

Laravel-iys paketini composer ile aşağıdaki komutu çalıştırarak kolayca ekleyebilirsiniz:

```bash
composer require tarfin-labs/laravel-iys
```

Sonrasında config dosyasını yayınlamanız gerekmektedir:

```bash
php artisan vendor:publish --provider="TarfinLabs\Iys\IysServiceProvider"
```

Konfigurasyonu tamamlamak için `.env` dosyasına aşağıdaki bilgileri eklemelisiniz:

```.dotenv
IYS_URL=
IYS_USERNAME=
IYS_PASSWORD=
IYS_CODE=
IYS_BRAND_CODE=
```

## Kullanım

IYS API dokümantasyonu ve dönen istek cevaplarına [https://dev.iys.org.tr/](https://dev.iys.org.tr/) adresinden ulaşabilirsiniz.

### Marka Yönetimi
#### Marka Listeleme:

```php
$response = Iys::brands()->all();
```

veya

```php
$iys = new \TarfinLabs\Iys\Iys();
$response = $iys->brands()->all();
```

### İzin Yönetimi
#### Tekil İzin Ekleme

```php
$response = Iys::consents()->create([
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
```

#### Tekil İzin Durumu Sorgulama
```php
$response = Iys::consents()->status([
                'recipient'     => '+905813334455',
                'recipientType' => 'BIREYSEL',
                'type'          => 'MESAJ',
            ]);
```

#### Asenkron Çoklu İzin Ekleme
```php
$response = Iys::consents()->createMany([
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
```
#### Çoklu İzin Ekleme İsteği Sorgulama
```php
$response = Iys::consents()->statuses($requestId = '73b75030-3a92-4f1e-b247-b0509dbadbfc');
```

### Bayi Yönetimi
#### Bayi Ekleme
```php
$response = Iys::retailers()->create([
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
```

#### Bayi Sorgulama ve Listeleme
- IYS numarası verilen bayi bilgilerini getirme:
```php
$response = Iys::retailers()->find($retailerCode = 66438915);
```

- Tüm bayiler detaylı bilgi ile birlikte:
```php
$response = Iys::retailers()->all();
```

- Sayfalama opsiyonları ile birlikte:
```php
$response = Iys::retailers()->all($offset = 100, $limit = 10);
```

#### Bayi Silme
```php
$response = Iys::retailers()->delete($retailerCode = 66438915);
```

### Bayi İzin Yönetimi
#### Bayi İzin Erişimi Ekleme
```php
$response = Iys::consents()->giveAccess([
                 'recipient' => '+905370000000',
                 'recipientType' => 'TACIR',
                 'type' => 'MESAJ',
                 'retailerAccess' =>  [66438915, 66438916],
             ]);
```

#### Bayi İzin Erişimi Verme
```php
$response = Iys::consents()->giveManyAccess([
                 'recipient'      => [
                     '+905370000000',
                     '+905370000001'
                 ],
                 'recipientType'  => 'TACIR',
                 'type'           => 'EPOSTA',
                 'retailerAccess' => [
                     66438915,
                     66438916
                 ],
             ]);
```

#### Bayi İzin Erişimi Sorgulama
- Sayfalama bilgileri ön tanımlı değerler ile istek:
```php
$response = Iys::consents()->accessList([
                 'recipient'     => 'ornek@deneme.com',
                 'recipientType' => 'TACIR',
                 'type'          => 'MESAJ',
             ]);
```

- Sayfalama bilgileri ile istek:
```php
$response = Iys::consents()->accessList([
                 'recipient'     => 'ornek@deneme.com',
                 'recipientType' => 'TACIR',
                 'type'          => 'MESAJ',
             ], 100, 10);
```

#### Bayi İzin Erişimi Silme
```php
$response = Iys::consents()->deleteAccess([
                 'recipients'     => [
                     '+905377115251',
                     '+905377115251',
                 ],
                 'recipientType'  => 'BIREYSEL',
                 'type'           => 'MESAJ',
                 'retailerAccess' => [
                     66438915,
                     66438916,
                 ],
             ]);
```

#### Tüm Bayilerin İzin Erişimini Silme
```php
$response = Iys::consents()->deleteAllAccess([
                 'recipients'     => [
                     '+905377115251',
                     '+905377115251',
                 ],
                 'recipientType'  => 'BIREYSEL',
                 'type'           => 'MESAJ',
             ]);
```

## Test

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

If you discover any security-related issues, please email development@tarfin.com instead of using the issue tracker.

## Credits

- [Faruk Can](https://github.com/frkcn)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


[https://dev.iys.org.tr/]: https://dev.iys.org.tr/
