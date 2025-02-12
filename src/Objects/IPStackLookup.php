<?php

namespace Arimolzer\IPStack\Objects;

use Arimolzer\IPStack\Exceptions\IPStackHydrationException;

class IPStackLookup
{
    protected string $ip;
    protected string $type;
    protected string $continentCode;
    protected string $continentName;
    protected string $countryCode;
    protected string $countryName;
    protected string $regionCode;
    protected string $regionName;
    protected string $city;
    protected string $zip;
    protected float $latitude;
    protected float $longitude;
    protected ?string $msa;
    protected ?string $dma;
    protected ?float $radius;
    protected ?string $ipRoutingType;
    protected ?string $connectionType;
    protected IPStackLocation $location;

    /**
     * @throws IPStackHydrationException
     */
    public function __construct(array $data)
    {
        try {
            $this->ip = $data['ip'];
            $this->type = $data['type'];
            $this->continentCode = $data['continent_code'];
            $this->continentName = $data['continent_name'];
            $this->countryCode = $data['country_code'];
            $this->countryName = $data['country_name'];
            $this->regionCode = $data['region_code'];
            $this->regionName = $data['region_name'];
            $this->city = $data['city'];
            $this->zip = $data['zip'];
            $this->latitude = $data['latitude'];
            $this->longitude = $data['longitude'];
            $this->msa = $data['msa'] ?? null;
            $this->dma = $data['dma'] ?? null;
            $this->radius = $data['radius'] ?? null;
            $this->ipRoutingType = $data['ip_routing_type'] ?? null;
            $this->connectionType = $data['connection_type'] ?? null;

            $this->location = new IPStackLocation($data['location']);
        } catch (\Throwable $e) {
            throw new IPStackHydrationException();
        }
    }

    public function getIP(): string
    {
        return $this->ip;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getContinentCode(): string
    {
        return $this->continentCode;
    }

    public function getContinentName(): string
    {
        return $this->continentName;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function getRegionCode(): string
    {
        return $this->regionCode;
    }

    public function getRegionName(): string
    {
        return $this->regionName;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getMsa(): ?string
    {
        return $this->msa;
    }

    public function getDma(): ?string
    {
        return $this->dma;
    }

    public function getRadius(): ?float
    {
        return $this->radius;
    }

    public function getIPRoutingType(): ?string
    {
        return $this->ipRoutingType;
    }

    public function getConnectionType(): ?string
    {
        return $this->connectionType;
    }

    public function getLocation(): IPStackLocation
    {
        return $this->location;
    }
}
