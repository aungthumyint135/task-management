<?php

namespace App\Common\Exceptions;

use Exception;

class UnauthenticatedException extends Exception
{
    protected $code = 403;

    protected $message = 'Unauthenticated';
}
