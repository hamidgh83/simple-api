<?php

namespace Core\Exception;

class RepositoryNotFoundException extends \RuntimeException
{
    protected $code = 500;

    protected $message = 'Repository not found.';
}
