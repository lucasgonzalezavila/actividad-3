<?php

namespace App\Database;

class QueryBuilder
{
    private $selectables = [];
    private $table;
    private $whereClause = '';
    private $limit = '';
    protected $pdo;
    private $bindings = [];

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }
    public function select(string $table, array $conditions = [], array $fields = ['*']): array {
        $fields = implode(', ', $fields);
        $query = "SELECT $fields FROM $table";

        if (!empty($conditions)) {
            $query .= " WHERE ";
            $conditionsStrings = [];
            foreach ($conditions as $field => $value) {
                $conditionsStrings[] = "$field = :$field";
            }
            $query .= implode(' AND ', $conditionsStrings);
        }

        $statement = $this->pdo->prepare($query);
        $statement->execute($conditions);

        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }
    /*
    public function select()
    {
        $this->selectables = func_get_args();
        return $this;
    }
    */
    public function table($table)
    {
    $this->table = $table;
    return $this;
    }

    public function from($table)
    {
        $this->table = $table;
        return $this;
    }

    public function delete(string $table, array $conditions): int {
        $query = "DELETE FROM $table WHERE ";
        $conditionsStrings = [];
        foreach ($conditions as $field => $value) {
            $conditionsStrings[] = "$field = :$field";
        }
        $query .= implode(' AND ', $conditionsStrings);

        $statement = $this->pdo->prepare($query);
        $statement->execute($conditions);

        return $statement->rowCount();
    }
    public function update(string $table, array $data, array $conditions): int {
        $fields = [];
        foreach ($data as $field => $value) {
            $fields[] = "$field = :$field";
        }
        $fields = implode(', ', $fields);

        $query = "UPDATE $table SET $fields WHERE ";
        $conditionsStrings = [];
        foreach ($conditions as $field => $value) {
            $conditionsStrings[] = "$field = :$field";
        }
        $query .= implode(' AND ', $conditionsStrings);

        $statement = $this->pdo->prepare($query);
        $mergedData = array_merge($data, $conditions);
        $statement->execute($mergedData);

        return $statement->rowCount();
    }

    public function findById(string $table, int $id): ?array {
        return $this->select($table, ['id' => $id])[0] ?? null;
    }

    public function where($column, $operator, $value)
    {
        $this->whereClause = "WHERE {$column} {$operator} :{$column}";
        $this->bindings[":{$column}"] = $value;
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = "LIMIT {$limit}";
        return $this;
    }

    public function prepare($query)
    {
        $statement = $this->pdo->prepare($query);

        foreach ($this->bindings as $parameter => $value) {
            $statement->bindParam($parameter, $value);
        }

        return $statement;
    }

    public function get()
    {
        $query = "SELECT " . implode(', ', $this->selectables) . " FROM {$this->table} {$this->whereClause} {$this->limit}";
        $statement = $this->prepare($query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function first(){
    $query = "SELECT " . implode(', ', $this->selectables) . " FROM {$this->table} {$this->whereClause} {$this->limit}";
    $statement = $this->prepare($query);
    $statement->execute();
    return $statement->fetch(\PDO::FETCH_OBJ); // Usar FETCH_OBJ para obtener un objeto estándar
    }

    public function insert(string $table, array $data): bool {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $query = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $statement = $this->pdo->prepare($query);

        return $statement->execute($data);
    }

}
