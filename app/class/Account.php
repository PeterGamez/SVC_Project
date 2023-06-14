<?php
class Account extends Database
{
    public static $table = 'account';

    public static function create($conditions)
    {
        return parent::buildCreate(self::$table, $conditions);
    }

    public static function find($conditions = [])
    {
        $sql = "SELECT * FROM " . self::$table . parent::buildWhereClause($conditions);
        return parent::buildFind($sql, $conditions);
    }

    public static function findOne($conditions)
    {
        $sql = "SELECT * FROM " . self::$table . parent::buildWhereClause($conditions);
        return parent::buildFindOne($sql, $conditions);
    }

    public static function count($conditions = [])
    {
        return parent::buildFindCount(self::$table, $conditions);
    }

    public static function update($conditions, $newData)
    {
        return parent::buildUpdate(self::$table, $conditions, $newData);
    }
    
    public static function delete($conditions)
    {
        return parent::buildDelete(self::$table, $conditions);
    }
}
