<?php

namespace App;

try {
    $conn = mysqli_connect(config('database.host'), config('database.user'), config('database.password'), config('database.database'));
    if (!$conn) {
        echo ('Connection failed: ' . mysqli_connect_error());
        die();
    }
} catch (\Exception $e) {
    echo ('Exception: database connection failed');
    die();
}

mysqli_set_charset($conn, 'utf8');
date_default_timezone_set("Asia/Bangkok");

class Database extends DataSelect
{
    // Main function
    public static function create(array $newData): int
    {
        if (isset($newData['create_at'])) unset($newData['create_at']);
        $newData['create_by'] = $_SESSION['user_id'];
        if (isset($newData['update_at'])) unset($newData['update_at']);
        $newData['update_by'] = $_SESSION['user_id'];

        $table = self::parseTable();
        $sql = "INSERT INTO $table" . self::buildInsertData($newData);
        return self::buildCreate($sql, $newData);
    }

    public static function find(): DataSelect
    {
        $table = self::parseTable();
        $instance = new parent($table);
        return $instance;
    }

    public static function findOne(array $conditions, string $operator = ''): array
    {
        $table = self::parseTable();
        $sql = "SELECT * FROM $table" . self::buildWhereClause($conditions, $operator);
        return self::buildFindOne($sql, $conditions);
    }

    public static function count(array $conditions = [], string $operator = '', array $group = []): int
    {
        $table = self::parseTable();
        $sql = "SELECT COUNT(*) as count FROM $table" . self::buildWhereClause($conditions, $operator) . self::buildGroupClause($group);
        return self::buildFindCount($sql, $conditions);
    }

    public static function update(array $conditions, array $newData): int
    {
        if (isset($newData['create_at'])) unset($newData['create_at']);
        if (isset($newData['create_by'])) unset($newData['create_by']);
        if (isset($newData['update_at'])) unset($newData['update_at']);
        $newData['update_by'] = $_SESSION['user_id'];

        $table = self::parseTable();
        $sql = "UPDATE $table" . self::buildSetData($newData) . self::buildWhereClause($conditions);
        return self::buildUpdate($sql, $conditions, $newData);
    }

    public static function delete(array $conditions): int
    {
        $table = self::parseTable();
        $sql = "DELETE FROM $table" . self::buildWhereClause($conditions);
        return self::buildDelete($sql, $conditions);
    }

    // Build Query
    private static function parseTable(): string
    {
        if (get_called_class() == 'Database') {
            throw new \Exception("Database class cannot be used directly");
        }
        $table = null;
        if (isset(get_called_class()::$table)) {
            $table = get_called_class()::$table;
        } else {
            $table = get_called_class();
            // 1. change first character to lowercase
            $table = lcfirst($table);
            // 2. change uppercase to underscore
            $table = preg_replace('/(?<!^)[A-Z]/', '_$0', $table);
            // 3. change uppercase to lowercase
            $table = strtolower($table);
        }
        return $table;
    }

    private static function bindParams($stmt, array $params): void
    {
        $types = "";
        $bindParams = [];

        foreach ($params as $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    if (is_int($v)) {
                        $types .= "i";
                    } else {
                        $types .= "s";
                    }
                    $bindParams[] = $v;
                }
                continue;
            } else if (is_int($value)) {
                $types .= "i";
            } else {
                $types .= "s";
            }
            $bindParams[] = $value;
        }
        $stmt->bind_param($types, ...$bindParams);
    }

    // Build Data
    protected static function buildInsertData(array $newData): string
    {
        $query = [];

        foreach ($newData as $field => $value) {
            $query[] = $field;
        }

        return " (" . implode(", ", $query) . ") VALUES (" . implode(", ", array_fill(0, count($query), "?")) . ")";
    }

    protected static function buildSetData(array $newData): string
    {
        $query = [];

        foreach ($newData as $field => $value) {
            $query[] = "$field = ?";
        }
        $query[] = "update_at = NOW()";

        return " SET " . implode(", ", $query);
    }

    // Build Clause
    protected static function buildWhereClause(array $conditions, string $operator = ''): string
    {
        if (empty($conditions)) {
            return "";
        }

        $query = [];

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                $query[] = "$field IN (" . implode(", ", array_fill(0, count($value), "?")) . ")";
            } else {
                $query[] = "$field = ?";
            }
        }

        $operator = strtoupper($operator);
        $operatorString = ($operator === "OR") ? " OR " : " AND ";

        return " WHERE " . implode($operatorString, $query);
    }

    protected static function buildGroupClause(array $group): string
    {
        if (empty($group)) {
            return "";
        }

        return " GROUP BY " . implode(", ", $group);
    }

    // Build result
    protected static function buildCreate(string $sql, array $conditions): ?int
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        self::bindParams($stmt, array_values($conditions));
        $stmt->execute();
        return $stmt->insert_id;
    }

    protected static function buildFind(string $sql, array $conditions): array
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        if (!empty($conditions)) {
            self::bindParams($stmt, array_values($conditions));
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    protected static function buildFindOne(string $sql, array $conditions): ?array
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        if (!empty($conditions)) {
            self::bindParams($stmt, array_values($conditions));
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result[0] ?? null;
    }

    protected static function buildFindCount(string $sql, array $conditions = []): ?int
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        if (!empty($conditions)) {
            self::bindParams($stmt, array_values($conditions));
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result[0]['count'] ?? null;
    }

    protected static function buildUpdate(string $sql, array $conditions, array $newData): int
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        self::bindParams($stmt, array_merge(array_values($newData), array_values($conditions)));
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        return $affectedRows;
    }

    protected static function buildDelete(string $sql, array $conditions): int
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        self::bindParams($stmt, array_values($conditions));
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        return $affectedRows;
    }
}

class DataSelect
{
    protected $query;
    protected $jointable = [];
    protected $whereConditions = [];
    protected $whereOperator;
    protected $bindParams = [];
    protected $order = [];
    protected $group = [];
    protected $limit;

    protected function __construct(string $table)
    {
        $this->query = "SELECT * FROM $table";
    }

    public function select(string ...$fields): self
    {
        $this->query = str_replace("*", implode(", ", $fields), $this->query);
        return $this;
    }

    public function join(string $table, string $column1, string $operator, string $column2, string $type = "INNER"): self
    {
        $this->jointable[] = " $type JOIN $table ON $column1 $operator $column2";
        return $this;
    }

    public function where(string $column, string $operator = "=", array|string $value): self
    {
        if (is_array($value)) {
            $placeholders = implode(', ', array_fill(0, count($value), '?'));
            $this->whereConditions[] = "$column $operator ($placeholders)";
            $this->bindParams = array_merge($this->bindParams, $value);
        } else {
            $this->whereConditions[] = "$column $operator ?";
            $this->bindParams[] = $value;
        }
        return $this;
    }

    public function operator(string $operator): self
    {
        $operator = strtoupper($operator);
        $this->whereOperator = ($operator === 'OR') ? 'OR' : 'AND';
        return $this;
    }

    public function order(string ...$columns): self
    {
        $this->order = $columns;
        return $this;
    }

    public function group(string ...$columns): self
    {
        $this->group = $columns;
        return $this;
    }

    public function limit(int $value): self
    {
        $this->limit = $value;
        return $this;
    }

    private function query(): void
    {
        if (!empty($this->jointable)) {
            $this->query .= implode(' ', $this->jointable);
        }

        if (!empty($this->whereConditions)) {
            $this->query .= " WHERE " . implode(' ' . $this->whereOperator . ' ', $this->whereConditions);
        }

        if (!empty($this->order)) {
            $this->query .= " ORDER BY " . implode(', ', $this->order);
        }

        if (!empty($this->group)) {
            $this->query .= " GROUP BY " . implode(', ', $this->group);
        }

        if ($this->limit) {
            $this->query .= " LIMIT " . $this->limit;
        }
    }

    public function get(): array
    {
        $this->query();
        return DataBase::buildFind($this->query, $this->bindParams);
    }

    public function getOne(): ?array
    {
        $this->query();
        return DataBase::buildFindOne($this->query, $this->bindParams);
    }
}
