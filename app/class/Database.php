<?php
class Database
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    private function bindParams($stmt, $params)
    {
        $types = "";
        $bindParams = [];

        foreach ($params as $value) {
            if (is_int($value)) {
                $types .= "i";
            } else {
                $types .= "s";
            }
            $bindParams[] = $value;
        }

        $stmt->bind_param($types, ...$bindParams);
    }

    public function buildConditions($conditions)
    {
        $query = [];

        foreach ($conditions as $field => $value) {
            $query[] = "$field = ?";
        }

        return implode(", ", $query);
    }

    public function buildWhereClause($conditions)
    {
        if (empty($conditions)) {
            return "";
        }

        $query = [];

        foreach ($conditions as $field => $value) {
            $query[] = "$field = ?";
        }

        return " WHERE " . implode(" AND ", $query);
    }

    public function DBcreate($sql, $params)
    {
        $stmt = $this->conn->prepare($sql);
        $this->bindParams($stmt, $params);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function find($sql, $params)
    {
        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $this->bindParams($stmt, $params);
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function findOne($sql, $params)
    {
        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $this->bindParams($stmt, $params);
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result ?? null;
    }

    public function update($sql, $conditions, $newData)
    {
        $stmt = $this->conn->prepare($sql);
        $bindParams = array_merge(array_values($newData), array_values($conditions));
        $this->bindParams($stmt, $bindParams);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        return $affectedRows;
    }

    public function delete($sql, $conditions)
    {
        $stmt = $this->conn->prepare($sql);
        $this->bindParams($stmt, array_values($conditions));
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        return $affectedRows;
    }
}
