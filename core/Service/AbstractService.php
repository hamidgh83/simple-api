<?php

namespace Core\Service;

use Core\Repository\DatabaseManager;

abstract class AbstractService implements ServiceInterface
{
    private $dbManager;

    public function setDatabaseManager(DatabaseManager $dbManager)
    {
        $this->dbManager = $dbManager;

        return $this;
    }

    public function getDatabaseManager(): DatabaseManager
    {
        return $this->dbManager;
    }

} 