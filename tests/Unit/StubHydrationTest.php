<?php

use Arimolzer\IPStack\Objects\IPStackLookup;

class StubHydrationTest extends \Arimolzer\IPStack\Tests\IPStackTestCase
{
    public function test_successfully_hydrates_single_stub()
    {
        // Read the contents of stubs/StandardLookupResponse.json and parse it into an array.
        // Create a new IPStackLookup object using the array.
        $lookup = new IPStackLookup(
            json_decode(file_get_contents(__DIR__ . '/../stubs/StandardLookupResponse.json'), true)
        );

        $this->validateHydratedLookup($lookup);
    }

    public function test_successfully_hydrates_bulk_stub()
    {
        // Read the contents of stubs/BulkLookupResponse.json and parse it into an array.
        $data = json_decode(file_get_contents(__DIR__ . '/../stubs/BulkLookupResponse.json'), true);

        // Create a collection of IPStackLookup objects using the array data
        $lookups = collect(array_map(fn($lookup) => new IPStackLookup($lookup), $data));

        $this->assertCount(3, $lookups);

        $this->assertEquals('California', $lookups[0]->getRegionName());

        $this->assertCount(1, $lookups[0]->getLocation()->getLanguages());
        $this->assertEquals('English', $lookups[0]->getLocation()->getLanguages()[0]->getName());
    }

    private function validateHydratedLookup(IPStackLookup $lookup): void
    {

    }
}
