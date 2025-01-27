<?php

namespace Arimolzer\IPStack\Exceptions;

use Exception;

class InvalidIPAddressFormatException extends Exception
{
    protected $message = 'The provided IP address is in an invalid IP address format.';
}
