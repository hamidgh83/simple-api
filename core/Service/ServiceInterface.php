<?php

namespace Core\Service;

use Core\Repository\RepositoryInterface;

interface ServiceInterface
{
    public function getRepository($name): RepositoryInterface;
}
