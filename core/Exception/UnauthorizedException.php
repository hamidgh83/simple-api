<?php

namespace Core\Exception;

class UnauthorizedException extends \RuntimeException
{
    protected $code = 403;

    protected $message = 'You are not authorized to access this resource.';
}
