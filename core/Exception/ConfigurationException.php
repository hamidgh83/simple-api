<?php

namespace Core\Exception;

class ConfigurationException extends \RuntimeException
{
    protected $code = 500;

    protected $message = 'Configuration is not loaded.';
}
