<?php

namespace Arimolzer\IPStack\Objects;

class IPStackLanguage
{
    public string $code;
    public string $name;
    public string $native;

    public function __construct(array $data)
    {
        $this->code = $data['code'];
        $this->name = $data['name'];
        $this->native = $data['native'];
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNative(): string
    {
        return $this->native;
    }
}
