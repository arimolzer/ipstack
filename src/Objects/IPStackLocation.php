<?php

namespace Arimolzer\IPStack\Objects;

class IPStackLocation
{
    protected int $geonameId;
    protected string $capital;
    protected array $languages;
    protected string $countryFlag;
    protected string $countryFlagEmoji;
    protected string $countryFlagEmojiUnicode;
    protected string $callingCode;
    protected bool $isEu;

    public function __construct(array $data)
    {
        $this->geonameId = $data['geoname_id'];
        $this->capital = $data['capital'];
        $this->languages = array_map(fn ($lang) => new IPStackLanguage($lang), $data['languages']);
        $this->countryFlag = $data['country_flag'];
        $this->countryFlagEmoji = $data['country_flag_emoji'];
        $this->countryFlagEmojiUnicode = $data['country_flag_emoji_unicode'];
        $this->callingCode = $data['calling_code'];
        $this->isEu = $data['is_eu'];
    }

    public function getGeonameId(): int
    {
        return $this->geonameId;
    }

    public function getCapital(): string
    {
        return $this->capital;
    }

    public function getLanguages(): array
    {
        return $this->languages;
    }

    public function getCountryFlag(): string
    {
        return $this->countryFlag;
    }

    public function getCountryFlagEmoji(): string
    {
        return $this->countryFlagEmoji;
    }

    public function getCountryFlagEmojiUnicode(): string
    {
        return $this->countryFlagEmojiUnicode;
    }

    public function getCallingCode(): string
    {
        return $this->callingCode;
    }

    public function isEu(): bool
    {
        return $this->isEu;
    }
}
