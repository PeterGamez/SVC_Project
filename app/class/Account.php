<?php
class Account
{
    public static function create($conditions)
    {
        $DB = new Database();
        $sql = "INSERT INTO account SET " . $DB->buildConditions($conditions);
        return $DB->create($sql, $conditions);
    }
    public static function find($conditions = [])
    {
        $DB = new Database();
        $sql = "SELECT * FROM account " . $DB->buildWhereClause($conditions);
        return $DB->find($sql, $conditions);
    }
    public static function findOne($conditions)
    {
        $DB = new Database();
        $sql = "SELECT * FROM account " . $DB->buildWhereClause($conditions);
        return $DB->findOne($sql, $conditions);
    }
    public static function update($conditions, $newData)
    {
        $DB = new Database();
        $sql = "UPDATE account SET " . $DB->buildConditions($newData) . $DB->buildWhereClause($conditions);
        return $DB->update($sql, $conditions, $newData);
    }
    public static function delete($conditions)
    {
        $DB = new Database();
        $sql = "DELETE FROM account" . $DB->buildWhereClause($conditions);
        return $DB->delete($sql, $conditions);
    }
}
