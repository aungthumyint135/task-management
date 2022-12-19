<?php

namespace App\Common\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected $code = 400;
}
