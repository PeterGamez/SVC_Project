<?php
try {
    $conn = mysqli_connect(config('database.host'), config('database.user'), config('database.password'), config('database.database'));
    if (!$conn) {
        echo ('Connection failed: ' . mysqli_connect_error());
        die();
    }
} catch (Exception $e) {
    echo ('Exception: database connection failed');
    die();
}

mysqli_set_charset($conn, 'utf8');
date_default_timezone_set("Asia/Bangkok");

class Database
{
    static private function bindParams($stmt, $params)
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

    static private function buildInsertConditions($conditions)
    {
        $query = [];

        foreach ($conditions as $field => $value) {
            $query[] = $field;
        }

        return " (" . implode(", ", $query) . ") VALUES (" . implode(", ", array_fill(0, count($query), "?")) . ")";
    }

    static private function buildSetConditions($conditions)
    {
        $query = [];

        foreach ($conditions as $field => $value) {
            $query[] = "$field = ?";
        }

        return " SET " . implode(", ", $query);
    }

    static protected function buildWhereClause($conditions, $operator = "AND")
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

    static protected function buildGroupClause($conditions)
    {
        if (empty($conditions)) {
            return "";
        }

        return " GROUP BY " . implode(", ", $conditions);
    }

    static protected function buildOrderClause($conditions)
    {
        if (empty($conditions)) {
            return "";
        }

        $order = [];

        foreach ($conditions as $field => $value) {
            $order[] = "$field $value";
        }

        return " ORDER BY " . implode(", ", $order);
    }

    static protected function buildCreate($table, $conditions)
    {
        $sql = "INSERT INTO $table " . self::buildInsertConditions($conditions);
        global $conn;
        $stmt = $conn->prepare($sql);
        self::bindParams($stmt, array_values($conditions));
        $stmt->execute();
        return $stmt->insert_id;
    }

    static protected function buildFind($sql, $conditions)
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

    static protected function buildFindOne($sql, $conditions)
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

    static protected function buildFindCount($table, $conditions = [])
    {
        $sql = "SELECT COUNT(*) as count FROM $table" . self::buildWhereClause($conditions);
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

    static protected function buildUpdate($table, $conditions, $newData)
    {
        $sql = "UPDATE $table" . self::buildSetConditions($newData) . self::buildWhereClause($conditions);
        global $conn;
        $stmt = $conn->prepare($sql);
        self::bindParams($stmt, array_merge(array_values($newData), array_values($conditions)));
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        return $affectedRows;
    }

    static protected function buildDelete($table, $conditions)
    {
        $sql = "DELETE FROM $table" . self::buildWhereClause($conditions);
        global $conn;
        $stmt = $conn->prepare($sql);
        self::bindParams($stmt, array_values($conditions));
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        return $affectedRows;
    }
}
