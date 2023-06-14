<?php
class Whitelist extends Database
{
    public static $table = 'whitelist';

    public static function create($conditions)
    {
        return parent::buildCreate(self::$table, $conditions);
    }

    public static function find($conditions = [])
    {
        $conditions = array_map(function ($key) {
            return "whitelist.$key";
        }, array_keys($conditions));
        $sql = "SELECT whitelist.*, whitelist_category.name as whitelist_category FROM whitelist
            INNER JOIN whitelist_category ON whitelist.whitelist_category_id = whitelist_category.id" . parent::buildWhereClause($conditions);
        return parent::buildFind($sql, $conditions);
    }

    public static function findOne($conditions)
    {
        $conditions = array_map(function ($key) {
            return "whitelist.$key";
        }, array_keys($conditions));

        $sql = "SELECT whitelist.*, whitelist_category.name as whitelist_category FROM whitelist
            INNER JOIN whitelist_category ON whitelist.whitelist_category_id = whitelist_category.id" . parent::buildWhereClause($conditions);
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
class Whitelist_Category extends Database
{
    public static $table = 'whitelist_category';

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
