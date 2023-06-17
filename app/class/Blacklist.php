<?php

class Blacklist extends Database
{
    public static $table = 'blacklist';

    public static function find($conditions = [], $operator = '')
    {
        $sql = "SELECT blacklist.*, blacklist_category.name as blacklist_category FROM blacklist
            INNER JOIN blacklist_category ON blacklist.blacklist_category_id = blacklist_category.id" . parent::buildWhereClause($conditions, $operator);
        return parent::buildFind($sql, $conditions);
    }

    public static function findOne($conditions, $operator = '')
    {
        $sql = "SELECT blacklist.*, blacklist_category.name as blacklist_category FROM blacklist
            INNER JOIN blacklist_category ON blacklist.blacklist_category_id = blacklist_category.id" . parent::buildWhereClause($conditions, $operator);
        return parent::buildFindOne($sql, $conditions);
    }
}

class BlacklistCategory extends Database
{
    public static $table = 'blacklist_category';
}
