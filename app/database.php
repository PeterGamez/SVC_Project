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

class Database
{
    // Main function
    public static function create(array $newData)
    {
        $newData['create_at'] = date('Y-m-d H:i:s');
        $newData['create_by'] = $_SESSION['user_id'];
        $newData['update_at'] = date('Y-m-d H:i:s');
        $newData['update_by'] = $_SESSION['user_id'];

        $table = self::parseTable();
        $sql = "INSERT INTO $table" . self::buildInsertData($newData);
        return self::buildCreate($sql, $newData);
    }

    public static function find(array $conditions = [], string $operator = '', array $order = [])
    {
        $table = self::parseTable();
        $sql = "SELECT * FROM $table" . self::buildWhereClause($conditions, $operator) . self::buildOrderClause($order);
        return self::buildFind($sql, $conditions);
    }

    public static function findOne(array $conditions, string $operator = '', array $order = [])
    {
        $table = self::parseTable();
        $sql = "SELECT * FROM $table" . self::buildWhereClause($conditions, $operator) . self::buildOrderClause($order);
        return self::buildFindOne($sql, $conditions);
    }

    public static function count(array $conditions = [], string $operator = '', array $group = [])
    {
        $table = self::parseTable();
        $sql = "SELECT COUNT(*) as count FROM $table" . self::buildWhereClause($conditions, $operator) . self::buildGroupClause($group);
        return self::buildFindCount($sql, $conditions);
    }

    public static function update(array $conditions, array $newData)
    {
        if (isset($newData['create_at'])) unset($newData['create_at']);
        if (isset($newData['create_by'])) unset($newData['create_by']);
        $newData['update_at'] = date('Y-m-d H:i:s');
        $newData['update_by'] = $_SESSION['user_id'];

        $table = self::parseTable();
        $sql = "UPDATE $table" . self::buildSetData($newData) . self::buildWhereClause($conditions);
        return self::buildUpdate($sql, $conditions, $newData);
    }

    public static function delete(array $conditions)
    {
        $table = self::parseTable();
        $sql = "DELETE FROM $table" . self::buildWhereClause($conditions);
        return self::buildDelete($sql, $conditions);
    }

    // Build Query
    private static function parseTable()
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

    private static function bindParams($stmt, array $params)
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
    protected static function buildInsertData(array $newData)
    {
        $query = [];

        foreach ($newData as $field => $value) {
            $query[] = $field;
        }

        return " (" . implode(", ", $query) . ") VALUES (" . implode(", ", array_fill(0, count($query), "?")) . ")";
    }

    protected static function buildSetData(array $newData)
    {
        $query = [];

        foreach ($newData as $field => $value) {
            $query[] = "$field = ?";
        }

        return " SET " . implode(", ", $query);
    }

    // Build Clause
    protected static function buildWhereClause(array $conditions, string $operator = '')
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

    protected static function buildGroupClause(array $group)
    {
        if (empty($group)) {
            return "";
        }

        return " GROUP BY " . implode(", ", $group);
    }

    protected static function buildOrderClause(array $order)
    {
        if (empty($order)) {
            return "";
        }

        $query = [];

        foreach ($order as $field => $value) {
            $query[] = "$field $value";
        }

        return " ORDER BY " . implode(", ", $query);
    }

    // Build result
    protected static function buildCreate(string $sql, array $conditions)
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        self::bindParams($stmt, array_values($conditions));
        $stmt->execute();
        return $stmt->insert_id;
    }

    protected static function buildFind(string $sql, array $conditions)
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

    protected static function buildFindOne(string $sql, array $conditions)
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

    protected static function buildFindCount(string $sql, array $conditions = [])
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

    protected static function buildUpdate(string $sql, array $conditions, array $newData)
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        self::bindParams($stmt, array_merge(array_values($newData), array_values($conditions)));
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        return $affectedRows;
    }

    protected static function buildDelete(string $sql, array $conditions)
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
