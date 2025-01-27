<?php


class ValidateConfigurationTest extends \Arimolzer\IPStack\Tests\IPStackTestCase
{
    public function test_environmental_variables_are_loaded()
    {
        $this->assertNotNull(getenv('IPSTACK_API_KEY'));
    }
}
