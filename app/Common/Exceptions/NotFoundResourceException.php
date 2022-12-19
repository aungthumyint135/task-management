<?php

namespace App\Common\Exceptions;

use Exception;

class NotFoundResourceException extends Exception
{
    protected $code = 404;

    protected $message = 'The requested resource ID does not exist.';
}
