<?php

namespace Core\Controller;

use Core\Http\Request;
use Core\Service\ServiceInterface;

interface ControllerInterface
{
    public function getRequest(): Request;

    public function setStatusCode($statusCode);

    public function getService(string $service, ...$options): ServiceInterface;
}
