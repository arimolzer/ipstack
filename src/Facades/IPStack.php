<?php

namespace Arimolzer\IPStack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Arimolzer\IPStack\IPStack get(string $ip)
 * @method static \Arimolzer\IPStack\IPStack getBulk(array $ips)
 */
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
