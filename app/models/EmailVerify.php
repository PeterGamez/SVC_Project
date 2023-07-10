<?php

namespace App\Models;

use App\Database;

class EmailVerify extends Database
{
    public static $table = 'email_verify';

    public static function create(array $newData)
    {
        if (isset($newData['create_at'])) unset($newData['create_at']);
        if (isset($newData['create_by'])) unset($newData['create_by']);
        if (isset($newData['update_at'])) unset($newData['update_at']);
        if (isset($newData['update_by'])) unset($newData['update_by']);

        $table = self::$table;
        $sql = "INSERT INTO $table" . parent::buildInsertData($newData);
        return parent::buildCreate($sql, $newData);
    }

    public static function findOne(array $conditions, string $operator = '', array $order = [])
    {
        $table = self::$table;
        $sql = "SELECT * FROM $table" . parent::buildWhereClause($conditions, $operator) . parent::buildOrderClause($order);
        return parent::buildFindOne($sql, $conditions);
    }

    public static function findEmail(array $conditions)
    {
        $table = self::$table;
        $sql = "SELECT * FROM $table WHERE email = ? AND verifed = 0 AND expired_at > NOW()";
        return parent::buildFindOne($sql, $conditions);
    }

    public static function findToken(array $conditions)
    {
        $table = self::$table;
        $sql = "SELECT * FROM $table WHERE token = ? AND verifed = 0 AND expired_at > NOW()";
        return parent::buildFindOne($sql, $conditions);
    }

    public static function update(array $conditions, array $newData)
    {
        if (isset($newData['create_at'])) unset($newData['create_at']);
        if (isset($newData['create_by'])) unset($newData['create_by']);
        if (isset($newData['update_at'])) unset($newData['update_at']);
        if (isset($newData['update_by'])) unset($newData['update_by']);

        $table = self::$table;
        $sql = "UPDATE $table" . parent::buildSetData($newData) . parent::buildWhereClause($conditions);
        return parent::buildUpdate($sql, $conditions, $newData);
    }

    public static function verifyToken(array $conditions)
    {
        $table = self::$table;
        $sql = "UPDATE $table SET verifed = 1 WHERE token = ? AND verifed = 0 AND expired_at > NOW()";
        return parent::buildUpdate($sql, $conditions, []);
    }
}
