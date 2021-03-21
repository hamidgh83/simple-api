<?php

namespace Core\Service;

use Core\Repository\DatabaseManager;

interface ServiceInterface 
{
    public function setDatabaseManager(DatabaseManager $dbManager);

    public function getDatabaseManager(): DatabaseManager;
}