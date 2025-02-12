<?php

use Arimolzer\IPStack\Objects\IPStackLookup;

class StubHydrationTest extends \Arimolzer\IPStack\Tests\IPStackTestCase
{
    public function test_successfully_hydrates_single_stub()
    {
        // Read the contents of stubs/StandardLookupResponse.json and parse it into an array.
        // Create a new IPStackLookup object using the array.
        $lookup = new IPStackLookup(
            json_decode(file_get_contents(__DIR__.'/../stubs/StandardLookupResponse.json'), true)
        );

        $this->validateHydratedLookup($lookup, 'US', 'CA', 'en');
    }

    public function test_successfully_hydrates_bulk_stub()
    {
        // Read the contents of stubs/BulkLookupResponse.json and parse it into an array.
        $data = json_decode(file_get_contents(__DIR__.'/../stubs/BulkLookupResponse.json'), true);

        // Create a collection of IPStackLookup objects using the array data
        $lookups = collect(array_map(fn ($lookup) => new IPStackLookup($lookup), $data));

        $this->assertCount(3, $lookups);

        $this->validateHydratedLookup($lookups[0], 'US', 'CA', 'en');
        $this->validateHydratedLookup($lookups[1], 'US', 'NY', 'en');
        $this->validateHydratedLookup($lookups[2], 'AU', 'NSW', 'en');
    }

    public function test_hydration_from_bad_stub()
    {
        $this->expectException(\Arimolzer\IPStack\Exceptions\IPStackHydrationException::class);

        // Read the contents of stubs/BadStandardLookupResponse.json and parse it into an array.
        $data = json_decode(file_get_contents(__DIR__.'/../stubs/BadStandardLookupResponse.json'), true);

        // Create a new IPStackLookup object using the array data
        new IPStackLookup($data);
    }

    private function validateHydratedLookup(
        IPStackLookup $lookup,
        string $countryCode,
        string $regionCode,
        string $languageCode
    ): void {
        $this->assertEquals($countryCode, $lookup->getCountryCode());
        $this->assertEquals($regionCode, $lookup->getRegionCode());
        $this->assertEquals($languageCode, $lookup->getLocation()->getLanguages()[0]->getCode());
    }
}
