<?php
class Whitelist extends Database
{
    public static $table = 'whitelist';

    public static function find($conditions = [], $operator = '')
    {
        $conditions = array_map(function ($key) {
            return "whitelist.$key";
        }, array_keys($conditions));
        $sql = "SELECT whitelist.*, whitelist_category.name as whitelist_category FROM whitelist
            INNER JOIN whitelist_category ON whitelist.whitelist_category_id = whitelist_category.id" . parent::buildWhereClause($conditions, $operator);
        return parent::buildFind($sql, $conditions);
    }

    public static function findOne($conditions, $operator = '')
    {
        $conditions = array_map(function ($key) {
            return "whitelist.$key";
        }, array_keys($conditions));

        $sql = "SELECT whitelist.*, whitelist_category.name as whitelist_category FROM whitelist
            INNER JOIN whitelist_category ON whitelist.whitelist_category_id = whitelist_category.id" . parent::buildWhereClause($conditions, $operator);
        return parent::buildFindOne($sql, $conditions);
    }
}
class WhitelistCategory extends Database
{
    public static $table = 'whitelist_category';
}
