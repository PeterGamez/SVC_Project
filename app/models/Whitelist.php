<?php

namespace App\Models;

use App\Database;

class Whitelist extends Database
{
    public static $table = 'whitelist';

    public static function find(array $conditions = [], string $operator = '', array $order = [])
    {
        $conditions = array_combine(array_map(function ($key) {
            return 'whitelist.' . $key;
        }, array_keys($conditions)), array_values($conditions));
        $sql = "SELECT whitelist.*, approve.name as approve FROM whitelist
            INNER JOIN approve ON whitelist.approve_id = approve.id" . parent::buildWhereClause($conditions, $operator) . parent::buildOrderClause($order);
        return parent::buildFind($sql, $conditions);
    }

    public static function findOne(array $conditions, string $operator = '', array $order = [])
    {
        $conditions = array_combine(array_map(function ($key) {
            return 'whitelist.' . $key;
        }, array_keys($conditions)), array_values($conditions));
        $sql = "SELECT whitelist.*, approve.name as approve FROM whitelist
            INNER JOIN approve ON whitelist.approve_id = approve.id" . parent::buildWhereClause($conditions, $operator) . parent::buildOrderClause($order);
        return parent::buildFindOne($sql, $conditions);
    }
}
