<?php

namespace KTS\src\Core;

use PDO;
use PDOStatement;

class Database
{
    public PDO $connection;

    protected PDOStatement $statement;

    protected static array $config = [];

    public function __construct(array $config, string $username = '', string $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        $this->setConfig($config);
    }

    public static function config(): array
    {
        return static::$config;
    }

    public function query(string $query, array $params = []): Database
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function get(): false|array
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (! $result) abort();

        return $result;
    }

    private function setConfig(array $config): void
    {
        self::$config = $config;
    }
}
