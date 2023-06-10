<?php
class Whitelist
{
    public static function create($conditions)
    {
        $DB = new Database();
        $sql = "INSERT INTO whitelist SET " . $DB->buildConditions($conditions);
        return $DB->create($sql, $conditions);
    }
    public static function find($conditions = [])
    {
        $conditions = array_map(function ($key) {
            return "whitelist.$key";
        }, array_keys($conditions));
        $DB = new Database();
        $sql = "SELECT whitelist.*, whitelist_category.name as whitelist_category FROM whitelist
            INNER JOIN whitelist_category ON whitelist.whitelist_category_id = whitelist_category.id" . $DB->buildWhereClause($conditions);
        return $DB->find($sql, $conditions);
    }
    public static function findOne($conditions)
    {
        $conditions = array_map(function ($key) {
            return "whitelist.$key";
        }, array_keys($conditions));

        $DB = new Database();
        $sql = "SELECT whitelist.*, whitelist_category.name as whitelist_category FROM whitelist
            INNER JOIN whitelist_category ON whitelist.whitelist_category_id = whitelist_category.id" . $DB->buildWhereClause($conditions);
        return $DB->findOne($sql, $conditions);
    }
    public static function update($conditions, $newData)
    {
        $DB = new Database();
        $sql = "UPDATE whitelist SET " . $DB->buildConditions($newData) . $DB->buildWhereClause($conditions);
        return $DB->update($sql, $conditions, $newData);
    }
    public static function delete($conditions)
    {
        $DB = new Database();
        $sql = "DELETE FROM whitelist" . $DB->buildWhereClause($conditions);
        return $DB->delete($sql, $conditions);
    }
}
class Whitelist_Category
{
    public static function create($conditions)
    {
        $DB = new Database();
        $sql = "INSERT INTO whitelist_category SET " . $DB->buildConditions($conditions);
        return $DB->create($sql, $conditions);
    }

    public static function find($conditions = [])
    {
        $DB = new Database();
        $sql = "SELECT * FROM whitelist_category" . $DB->buildWhereClause($conditions);
        return $DB->find($sql, $conditions);
    }

    public static function findOne($conditions)
    {
        $DB = new Database();
        $sql = "SELECT * FROM whitelist_category" . $DB->buildWhereClause($conditions);
        return $DB->findOne($sql, $conditions);
    }

    public static function update($conditions, $newData)
    {
        $DB = new Database();
        $sql = "UPDATE whitelist_category SET " . $DB->buildConditions($newData) . $DB->buildWhereClause($conditions);
        return $DB->update($sql, $conditions, $newData);
    }

    public static function delete($conditions)
    {
        $DB = new Database();
        $sql = "DELETE FROM whitelist_category" . $DB->buildWhereClause($conditions);
        return $DB->delete($sql, $conditions);
    }
}
