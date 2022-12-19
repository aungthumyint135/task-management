<?php

namespace App\Common\Exceptions;

use Exception;

class DuplicateEntryException extends Exception
{
    protected $code = 409;
}
