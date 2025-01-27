<?php

namespace Arimolzer\IPStack\Exceptions;

use Exception;

class IPStackAPIException extends Exception
{
    protected $message = 'An error occurred when making a request to the IPStack API.';
}
