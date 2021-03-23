<?php

namespace Core\Repository;

use Doctrine\DBAL\Query\QueryBuilder;

abstract class AbstractRepository implements RepositoryInterface
{
    private $dbManager;

    public function __construct()
    {
        $this->dbManager = DatabaseManager::getInstance();
    }

    public function getDatabaseManager(): DatabaseManager
    {
        return $this->dbManager;
    }

    public function queryBuilder(): QueryBuilder
    {
        return $this->dbManager->getQueryBuilder();
    }
}
