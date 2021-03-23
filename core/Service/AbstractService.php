<?php

namespace Core\Service;

use Core\Exception\RepositoryNotFoundException;
use Core\Repository\RepositoryInterface;

abstract class AbstractService implements ServiceInterface
{
    public function getRepository($name): RepositoryInterface
    {
        if (! class_exists($name)) {
            throw new RepositoryNotFoundException();
        }

        return new $name();
    }
}
