<?php
class Whitelist extends Database
{
    public static function create($conditions)
    {
        $sql = "INSERT INTO whitelist" . parent::buildInsertConditions($conditions);
        return parent::buildCreate($sql, $conditions);
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

    public static function count($conditions = [], $operator = null)
    {
        $sql = "SELECT COUNT(*) as count FROM whitelist" . parent::buildWhereClause($conditions, $operator);
        return parent::buildFindOne($sql, $conditions)['count'];
    }

    public static function update($conditions, $newData)
    {
        $sql = "UPDATE whitelist" . parent::buildSetConditions($newData) . parent::buildWhereClause($conditions);
        return parent::buildUpdate($sql, $conditions, $newData);
    }
    
    public static function delete($conditions)
    {
        $sql = "DELETE FROM whitelist" . parent::buildWhereClause($conditions);
        return parent::buildDelete($sql, $conditions);
    }
}
class Whitelist_Category extends Database
{
    public static function create($conditions)
    {
        $sql = "INSERT INTO whitelist_category" . parent::buildInsertConditions($conditions);
        return parent::buildCreate($sql, $conditions);
    }

    public static function find($conditions = [])
    {
        $sql = "SELECT * FROM whitelist_category" . parent::buildWhereClause($conditions);
        return parent::buildFind($sql, $conditions);
    }

    public static function findOne($conditions)
    {
        $sql = "SELECT * FROM whitelist_category" . parent::buildWhereClause($conditions);
        return parent::buildFindOne($sql, $conditions);
    }

    public static function update($conditions, $newData)
    {
        $sql = "UPDATE whitelist_category" . parent::buildSetConditions($newData) . parent::buildWhereClause($conditions);
        return parent::buildUpdate($sql, $conditions, $newData);
    }

    public static function delete($conditions)
    {
        $sql = "DELETE FROM whitelist_category" . parent::buildWhereClause($conditions);
        return parent::buildDelete($sql, $conditions);
    }
}
