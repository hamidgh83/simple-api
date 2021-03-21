<?php

namespace Core\Repository;

use Doctrine\DBAL\DriverManager;

class DatabaseManager
{
    private static $instance = null;
    
    private $dbConnection;
  
    private function __construct()
    {
    }
    
    public static function getInstance()
    {
        if (self::$instance == null) {
            $dbManager = new DatabaseManager();
            self::$instance = $dbManager->setDbConnection();

            return self::$instance;
        }
    
        return self::$instance;
    }

    private function setDbConnection()
    {
        $this->dbConnection = DriverManager::getConnection($this->getConnectionParams());

        return $this;
    }

    private function getConnectionParams(): array
    {
        return [
            'dbname' => $_ENV['DATABASE_NAME'] ?? null,
            'user' => $_ENV['DATABASE_USER'] ?? null,
            'password' => $_ENV['DATABASE_PASSWORD'] ?? null,
            'host' => $_ENV['DATABASE_HOST'] ?? null,
            'driver' => $_ENV['DATABASE_DRIVER'] ?? null,
        ];
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }

    public function getQueryBuilder()
    {
        return $this->dbConnection->createQueryBuilder();
    }
}
