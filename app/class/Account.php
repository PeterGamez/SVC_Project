<?php
class Account extends Database
{
    public static function create($conditions)
    {
        $sql = "INSERT INTO account" . parent::buildInsertConditions($conditions);
        return parent::buildCreate($sql, $conditions);
    }
    public static function find($conditions = [])
    {
        $sql = "SELECT * FROM account" . parent::buildWhereClause($conditions);
        return parent::buildFind($sql, $conditions);
    }
    public static function findOne($conditions)
    {
        $sql = "SELECT * FROM account" . parent::buildWhereClause($conditions);
        return parent::buildFindOne($sql, $conditions);
    }
    public static function count($conditions = [], $operator = null)
    {
        $sql = "SELECT COUNT(*) as count FROM account" . parent::buildWhereClause($conditions, $operator);
        return parent::buildFindOne($sql, $conditions)['count'];
    }
    public static function update($conditions, $newData)
    {
        $sql = "UPDATE account" . parent::buildSetConditions($newData) . parent::buildWhereClause($conditions);
        return parent::buildUpdate($sql, $conditions, $newData);
    }
    public static function delete($conditions)
    {
        $sql = "DELETE FROM account" . parent::buildWhereClause($conditions);
        return parent::buildDelete($sql, $conditions);
    }
}
