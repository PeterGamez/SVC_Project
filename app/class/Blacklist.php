<?php

class Blacklist
{
    public static function create($conditions)
    {
        $DB = new Database();
        $sql = "INSERT INTO blacklist SET " . $DB->buildConditions($conditions);
        return $DB->create($sql, $conditions);
    }

    public static function find($conditions = [])
    {
        $DB = new Database();
        $sql = "SELECT blacklist.*, blacklist_category.name as blacklist_category FROM blacklist
            INNER JOIN blacklist_category ON blacklist.blacklist_category_id = blacklist_category.id";
        return $DB->find($sql, $conditions);
    }

    public static function findOne($conditions)
    {
        $DB = new Database();
        $sql = "SELECT blacklist.*, blacklist_category.name as blacklist_category FROM blacklist
            INNER JOIN blacklist_category ON blacklist.blacklist_category_id = blacklist_category.id" . $DB->buildWhereClause($conditions);
        return $DB->findOne($sql, $conditions);
    }

    public static function update($conditions, $newData)
    {
        $DB = new Database();
        $sql = "UPDATE blacklist SET " . $DB->buildConditions($newData) . $DB->buildWhereClause($conditions);
        return $DB->update($sql, $conditions, $newData);
    }

    public static function delete($conditions)
    {
        $DB = new Database();
        $sql = "DELETE FROM blacklist" . $DB->buildWhereClause($conditions);
        return $DB->delete($sql, $conditions);
    }
}

class Blacklist_Category
{
    public static function create($conditions)
    {
        $DB = new Database();
        $sql = "INSERT INTO blacklist_category SET " . $DB->buildConditions($conditions);
        return $DB->create($sql, $conditions);
    }

    public static function find($conditions = [])
    {
        $DB = new Database();
        $sql = "SELECT * FROM blacklist_category" . $DB->buildWhereClause($conditions);
        return $DB->find($sql, $conditions);
    }

    public static function findOne($conditions)
    {
        $DB = new Database();
        $sql = "SELECT * FROM blacklist_category" . $DB->buildWhereClause($conditions);
        return $DB->findOne($sql, $conditions);
    }

    public static function update($conditions, $newData)
    {
        $DB = new Database();
        $sql = "UPDATE blacklist_category SET " . $DB->buildConditions($newData) . $DB->buildWhereClause($conditions);
        return $DB->update($sql, $conditions, $newData);
    }

    public static function delete($conditions)
    {
        $DB = new Database();
        $sql = "DELETE FROM blacklist_category" . $DB->buildWhereClause($conditions);
        return $DB->delete($sql, $conditions);
    }
}