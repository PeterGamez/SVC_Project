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

    static public function buildInsertConditions($conditions)
    {
        $query = [];

        foreach ($conditions as $field => $value) {
            $query[] = $field;
        }

        return " (" . implode(", ", $query) . ") VALUES (" . implode(", ", array_fill(0, count($query), "?")) . ")";
    }

    static public function buildSetConditions($conditions)
    {
        $query = [];

        foreach ($conditions as $field => $value) {
            $query[] = "$field = ?";
        }

        return " SET " . implode(", ", $query);
    }

    static public function buildWhereClause($conditions, $operator = "AND")
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

    static public function buildCreate($sql, $params)
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        self::bindParams($stmt, $params);
        $stmt->execute();
        return $stmt->insert_id;
    }

    static public function buildFind($sql, $params)
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        if (!empty($params)) {
            self::bindParams($stmt, $params);
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    static public function buildFindOne($sql, $params)
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        if (!empty($params)) {
            self::bindParams($stmt, $params);
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result[0] ?? null;
    }

    static public function buildUpdate($sql, $conditions, $newData)
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        $bindParams = array_merge(array_values($newData), array_values($conditions));
        self::bindParams($stmt, $bindParams);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        return $affectedRows;
    }

    static public function buildDelete($sql, $conditions)
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
