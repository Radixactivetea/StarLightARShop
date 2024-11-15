<?php

class Database
{
    public $connection;
    protected $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function executeQuery($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        return $this->statement->execute($params);
    }


    public function fetch()
    {
        $result = $this->statement->fetch();

        return $result;
    }

    public function fetchAll()
    {
        $result = $this->statement->fetchAll();

        return $result;
    }

    public function get()
    {
        $result = $this->statement->fetch();

        if (!$result) {
            header("Location: /404");
            exit();
        }

        return $result;
    }

    public function getAll()
    {
        $result = $this->statement->fetchAll();

        if (!$result) {
            header("Location: /404");
            exit();
        }

        return $result;
    }
}