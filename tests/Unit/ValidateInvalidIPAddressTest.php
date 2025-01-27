<?php


class ValidateInvalidIPAddressTest extends \Arimolzer\IPStack\Tests\IPStackTestCase
{
    public function test_invalid_ip_address_exception()
    {
        $this->assertThrows(function () {

            $this->ipStackService->get('127.0.0.1');

        }, \Arimolzer\IPStack\Exceptions\IPStackHydrationException::class);
    }
}
