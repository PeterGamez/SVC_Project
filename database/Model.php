<?php

namespace Database;

use Exception;

class Model extends DataSelect
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

    public static function find($conditions = null): parent
    {
        $table = self::parseTable();
        $instance = new parent($table, $conditions);
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

    /**
     * Show table status
     */
    public static function status(): array
    {
        $table = self::parseTable();
        $sql = "SHOW TABLE STATUS LIKE $table";
        return self::buildStatus($sql);
    }

    // Build Query
    private static function parseTable(): string
    {
        if (get_called_class() == 'Database') {
            throw new Exception("Database class cannot be used directly");
        }
        $table = null;
        if (isset(get_called_class()::$table)) {
            $table = get_called_class()::$table;
        } else {
            $table = get_called_class(); // get class name
            $table = lcfirst($table); // change first character to lowercase
            $table = preg_replace('/(?<!^)[A-Z]/', '_$0', $table); // add underscore before uppercase
            $table = strtolower($table); // change uppercase to lowercase
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
        return;
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
        $result = $stmt->insert_id;
        $stmt->close();
        return $result;
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

    protected static function buildStatus(string $sql): array
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result[0][0] ?? null;
    }
}
