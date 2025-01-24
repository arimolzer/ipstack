<?php

namespace Arimolzer\IPStack\Facades;

use Illuminate\Support\Facades\Facade;

class IPStack extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ipstack';
    }
}
