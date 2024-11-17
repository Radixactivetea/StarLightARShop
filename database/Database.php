<?php


class Database
{
    private $connection;
    private $statement;

    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

        try {
            $this->connection = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function query($query, $params = [])
    {
        try {
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($params);
            return $this;
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }

    public function find($table, $conditions = [], $columns = '*')
    {
        // Convert columns array to string if necessary
        if (is_array($columns)) {
            $columns = implode(', ', $columns);
        }

        $query = "SELECT {$columns} FROM {$table}";
        $params = [];

        // If conditions are provided
        if (!empty($conditions)) {
            $where = [];

            foreach ($conditions as $key => $value) {
                // Handle different operators
                if (is_array($value)) {
                    // Format: ['column' => ['>', 100]]
                    $operator = $value[0];
                    $actualValue = $value[1];
                    $where[] = "{$key} {$operator} :{$key}";
                    $params[$key] = $actualValue;
                } else {
                    // Default equals operator
                    $where[] = "{$key} = :{$key}";
                    $params[$key] = $value;
                }
            }

            $query .= " WHERE " . implode(' AND ', $where);
        }

        return $this->query($query, $params)->fetch();
    }

    public function findAll($table, $conditions = [], $options = [])
    {
        // Start building the query
        $query = "SELECT";

        // Handle columns
        $columns = $options['columns'] ?? '*';
        if (is_array($columns)) {
            $query .= ' ' . implode(', ', $columns);
        } else {
            $query .= ' ' . $columns;
        }

        $query .= " FROM {$table}";
        $params = [];

        // Handle WHERE conditions
        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $key => $value) {
                if (is_array($value)) {
                    // Handle operators: ['price' => ['>', 100]]
                    $operator = $value[0];
                    $actualValue = $value[1];
                    $where[] = "{$key} {$operator} :{$key}";
                    $params[$key] = $actualValue;
                } else {
                    // Handle simple equals: ['status' => 'active']
                    $where[] = "{$key} = :{$key}";
                    $params[$key] = $value;
                }
            }
            $query .= " WHERE " . implode(' AND ', $where);
        }

        // Handle ORDER BY
        if (!empty($options['orderBy'])) {
            $query .= " ORDER BY " . $options['orderBy'];
        }

        // Handle LIMIT
        if (!empty($options['limit'])) {
            $query .= " LIMIT " . (int) $options['limit'];

            // Handle OFFSET for pagination
            if (!empty($options['offset'])) {
                $query .= " OFFSET " . (int) $options['offset'];
            }
        }

        return $this->query($query, $params)->fetchAll();
    }
    public function insert($table, $data)
    {
        $fields = array_keys($data);
        $placeholders = array_map(fn($field) => ":{$field}", $fields);

        $query = "INSERT INTO {$table} (" . implode(', ', $fields) . ") 
                 VALUES (" . implode(', ', $placeholders) . ")";

        $this->query($query, $data);
        return $this->connection->lastInsertId();
    }

    public function update($table, $id, $data)
    {
        $fields = array_map(fn($field) => "{$field} = :{$field}", array_keys($data));

        $query = "UPDATE {$table} 
                 SET " . implode(', ', $fields) . " 
                 WHERE id = :id";

        $data['id'] = $id;
        return $this->query($query, $data);
    }

    public function delete($table, $id)
    {
        return $this->query(
            "DELETE FROM {$table} WHERE id = :id",
            ['id' => $id]
        );
    }

    public function findOrFail($table, $conditions = [], $columns = '*')
    {
        $result = $this->find($table, $conditions, $columns);

        if (!$result) {
            throw new Exception("Record not found in {$table}");
        }

        return $result;
    }

    public function fetch()
    {
        return $this->statement->fetch();
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll();
    }
}