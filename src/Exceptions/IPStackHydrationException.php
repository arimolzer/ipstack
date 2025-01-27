<?php

namespace Arimolzer\IPStack\Exceptions;

use Exception;

class IPStackHydrationException extends Exception
{
    protected $message = 'An error occurred when attempting to hydrate from an IPStack response.';
}
