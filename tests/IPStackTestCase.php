<?php

namespace Arimolzer\IPStack\Tests;

use Arimolzer\IPStack\IPStack;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

abstract class IPStackTestCase extends TestCase
{
    protected IPStack $ipStackService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('ipstack', require __DIR__.'/../config/ipstack.php');

        $this->ipStackService = $this->app->make(IPStack::class);
    }

    /**
     * @param Application $app
     * @return class-string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            \Arimolzer\IPStack\IPStackServiceProvider::class
        ];
    }

    /**
     * @param Application $app
     * @return class-string[]
     */
    protected function getPackageAliases($app): array
    {
        return [
            'IPStack' => \Arimolzer\IPStack\Facades\IPStack::class,
        ];
    }
}
