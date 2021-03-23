<?php

use Application\Service\UserService;
use Core\Service\UserServiceInterface;

return [
    "factories" => [
        "services" => [
            UserServiceInterface::class => UserService::class,
        ],
    ],
];
