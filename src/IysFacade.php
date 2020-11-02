<?php

namespace TarfinLabs\Iys;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TarfinLabs\Iys\Iys
 */
class IysFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'iys';
    }
}
