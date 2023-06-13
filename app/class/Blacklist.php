<?php

class Blacklist extends Database
{
    public static function create($conditions)
    {
        $sql = "INSERT INTO blacklist" . parent::buildInsertConditions($conditions);
        return parent::buildCreate($sql, $conditions);
    }

    public static function find($conditions = [])
    {
        $sql = "SELECT blacklist.*, blacklist_category.name as blacklist_category FROM blacklist
            INNER JOIN blacklist_category ON blacklist.blacklist_category_id = blacklist_category.id" . parent::buildWhereClause($conditions);
        return parent::buildFind($sql, $conditions);
    }

    public static function findOne($conditions)
    {
        $sql = "SELECT blacklist.*, blacklist_category.name as blacklist_category FROM blacklist
            INNER JOIN blacklist_category ON blacklist.blacklist_category_id = blacklist_category.id" . parent::buildWhereClause($conditions);
        return parent::buildFindOne($sql, $conditions);
    }

    public static function count($conditions = [], $operator = null)
    {
        $sql = "SELECT COUNT(*) as count FROM blacklist" . parent::buildWhereClause($conditions, $operator);
        return parent::buildFindOne($sql, $conditions)['count'];
    }

    public static function update($conditions, $newData)
    {
        $sql = "UPDATE blacklist" . parent::buildSetConditions($newData) . parent::buildWhereClause($conditions);
        return parent::buildUpdate($sql, $conditions, $newData);
    }

    public static function delete($conditions)
    {
        $sql = "DELETE FROM blacklist" . parent::buildWhereClause($conditions);
        return parent::buildDelete($sql, $conditions);
    }
}

class Blacklist_Category extends Database
{
    public static function create($conditions)
    {
        $sql = "INSERT INTO blacklist_category" . parent::buildInsertConditions($conditions);
        return parent::buildCreate($sql, $conditions);
    }

    public static function find($conditions = [])
    {
        $sql = "SELECT * FROM blacklist_category" . parent::buildWhereClause($conditions);
        return parent::buildFind($sql, $conditions);
    }
    public static function findOne($conditions)
    {
        $sql = "SELECT * FROM blacklist_category" . parent::buildWhereClause($conditions);
        return parent::buildFindOne($sql, $conditions);
    }

    public static function update($conditions, $newData)
    {
        $sql = "UPDATE blacklist_category" . parent::buildSetConditions($newData) . parent::buildWhereClause($conditions);
        return parent::buildUpdate($sql, $conditions, $newData);
    }

    public static function delete($conditions)
    {
        $sql = "DELETE FROM blacklist_category" . parent::buildWhereClause($conditions);
        return parent::buildDelete($sql, $conditions);
    }
}
