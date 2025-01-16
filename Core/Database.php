<?php


namespace Core;

use PDO;
use PDOException;
use Exception;
use InvalidArgumentException;

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

    public function transaction(callable $callback)
    {
        try {
            // Begin the transaction
            $this->connection->beginTransaction();

            // Call the callback function, passing the database instance
            $callback($this);

            // If no exception is thrown, commit the transaction
            $this->connection->commit();
        } catch (Exception $e) {
            // Rollback if any exception occurs
            $this->connection->rollBack();

            // Re-throw the exception to be handled outside
            throw $e;
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

    public function update($table, $identifier, $data, $primaryKey = 'id')
    {
        // Ensure there is data to update
        if (empty($data)) {
            throw new InvalidArgumentException("Data array cannot be empty.");
        }

        // Build the SET part of the query
        $fields = array_map(fn($field) => "{$field} = :{$field}", array_keys($data));

        // Construct the SQL query
        $query = "UPDATE {$table} 
              SET " . implode(', ', $fields) . " 
              WHERE {$primaryKey} = :primaryKey";

        // Add the identifier to the parameters
        $data['primaryKey'] = $identifier;

        // Execute the query
        return $this->query($query, $data);
    }

    public function delete($table, $conditions = [])
    {
        // Start building the base query
        $query = "DELETE FROM {$table}";
        $params = [];

        // If conditions are provided, add them to the query
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

        // Execute the query with the parameters
        return $this->query($query, $params);
    }

    public function findOrFail($table, $conditions = [], $columns = '*')
    {
        $result = $this->find($table, $conditions, $columns);

        if (!$result) {

            redirect('/404', 404);
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

    public function generateUniqueOrderId()
    {
        $maxAttempts = 10; // Prevent infinite loops
        $attempt = 0;

        do {
            // Generate a random 16-digit number
            // Using mt_rand() for better randomization
            $orderId = mt_rand(1000000000000000, 9999999999999999);

            // Check if this ID already exists
            $exists = $this->find('orders', ['order_id' => $orderId]);

            $attempt++;

            // If we found a unique ID or reached max attempts, break the loop
            if (!$exists || $attempt >= $maxAttempts) {
                break;
            }
        } while (true);

        // If we couldn't generate a unique ID after max attempts
        if ($attempt >= $maxAttempts && $exists) {
            throw new Exception("Could not generate unique order ID after {$maxAttempts} attempts");
        }

        return $orderId;
    }
}