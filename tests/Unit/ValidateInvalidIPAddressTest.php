<?php

class ValidateInvalidIPAddressTest extends \Arimolzer\IPStack\Tests\IPStackTestCase
{
    public function test_invalid_ip_address_exception()
    {
        $this->expectException(\Arimolzer\IPStack\Exceptions\IPStackHydrationException::class);

        $this->ipStackService->get('127.0.0.1');
    }
}
