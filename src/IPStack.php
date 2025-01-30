<?php

namespace Arimolzer\IPStack;

use Arimolzer\IPStack\Exceptions\InvalidIPAddressFormatException;
use Arimolzer\IPStack\Exceptions\IPStackAPIException;
use Arimolzer\IPStack\Exceptions\IPStackHydrationException;
use Arimolzer\IPStack\Objects\IPStackLookup;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class IPStack
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('ipstack.base_uri'),
            'errors' => false
        ]);
    }

    /**
     * @param array $ips
     * @return Collection
     * @throws GuzzleException|IPStackAPIException|InvalidIPAddressFormatException
     */
    public function getBulk(array $ips): Collection
    {
        $this->validateIpAddress($ips);

        $imploded = implode(',', $ips);

        $response = $this->client
            ->get(sprintf('%s?access_key=%s', $imploded, config('ipstack.api_key')));

        /** @var array $responseBody */
        $responseBody = json_decode($response->getBody()->getContents(), true);

        $IPStackResponses = collect();

        if ($this->responseWasSuccessful($responseBody)) {
            array_map(fn($result) => $IPStackResponses->push(new IPStackLookup($result)), $responseBody);
            return $IPStackResponses;
        }

        $this->handleUnsuccessfulResponseStatusCode($responseBody);
    }

    /**
     * @param string|array $ips
     * @return void
     * @throws InvalidIPAddressFormatException
     */
    private function validateIpAddress(string|array $ips): void
    {
        $ipv4Pattern = '/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/';

        $ipv6Pattern = '/^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]|[1-9]|)[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]|[1-9]|)[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]|[1-9]|)[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]|[1-9]|)[0-9]))$/';

        if (is_array($ips)) {
            foreach ($ips as $ip) {
                $this->validateIpAddress($ip);
            }
        } else {
            if (!preg_match($ipv4Pattern, $ips) && !preg_match($ipv6Pattern, $ips)) {
                throw new InvalidIPAddressFormatException($ips);
            }
        }
    }

    /**
     * @param string $ip
     * @return IPStackLookup
     * @throws GuzzleException|IPStackAPIException|InvalidIPAddressFormatException
     * @throws IPStackHydrationException
     */
    public function get(string $ip): IPStackLookup
    {
        $this->validateIpAddress($ip);

        $response = $this->client->get(sprintf('%s?access_key=%s', $ip, config('ipstack.api_key')));

        $responseBody = json_decode($response->getBody()->getContents(), true);

        if ($this->responseWasSuccessful($responseBody)) {

            return new IPStackLookup($responseBody);
        }

        $this->handleUnsuccessfulResponseStatusCode($responseBody);
    }

    /**
     * IPStack responses always return a HTTP200 response. Instead, the response code is included as part of the payload
     * if the request was unsuccessful. This method checks if the response was successful, and if not, throws an
     * appropriate exception.
     * https://ipstack.com/documentation#errors
     *
     * @param array $responseBody
     * @return bool
     */
    private function responseWasSuccessful(array $responseBody): bool
    {
        // Check if the request was successful.
        // Strangely, the 'success' key only exists if the request was unsuccessful.
        return !array_key_exists('success', $responseBody);
    }

    /**
     * @param array $responseBody
     * @return void
     * @throws IPStackAPIException
     */
    private function handleUnsuccessfulResponseStatusCode(array $responseBody): void
    {
        $error = sprintf(
            'IPStack Exception: %d %s - %s',
            $responseBody['error']['code'],
            $responseBody['error']['type'],
            $responseBody['error']['info']
        );

        throw new IPStackAPIException($error);
    }
}
