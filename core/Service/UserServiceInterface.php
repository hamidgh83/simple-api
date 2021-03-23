<?php

namespace Core\Service;

use Core\Model\UserInterface;

interface UserServiceInterface
{
    public function authenticate($token): ?UserInterface;
}
