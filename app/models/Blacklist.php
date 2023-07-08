<?php

namespace App\Models;

use App\Database;

class Blacklist extends Database
{
    public static $table = 'blacklist';

    public static function find(array $conditions = [], string $operator = '', array $order = [])
    {
        $conditions = array_combine(array_map(function ($key) {
            return 'blacklist.' . $key;
        }, array_keys($conditions)), array_values($conditions));
        $sql = "SELECT blacklist.*, approve.name as approve FROM blacklist
            INNER JOIN blacklist_category ON blacklist.blacklist_category_id = blacklist_category.id
            INNER JOIN approve ON blacklist.approve_id = approve.id"
            . parent::buildWhereClause($conditions, $operator) . parent::buildOrderClause($order);
        return parent::buildFind($sql, $conditions);
    }

    public static function findOne(array $conditions = [], string $operator = '', array $order = [])
    {
        $conditions = array_combine(array_map(function ($key) {
            return 'blacklist.' . $key;
        }, array_keys($conditions)), array_values($conditions));
        $sql = "SELECT blacklist.*, approve.name as approve FROM blacklist
            INNER JOIN blacklist_category ON blacklist.blacklist_category_id = blacklist_category.id
            INNER JOIN approve ON blacklist.approve_id = approve.id"
            . parent::buildWhereClause($conditions, $operator) . parent::buildOrderClause($order);
        return parent::buildFindOne($sql, $conditions);
    }
}
