<?php

namespace Core\Controller;

interface RequiredAuthenticationInterface
{
    public function authenticatedActions(): array;
}
