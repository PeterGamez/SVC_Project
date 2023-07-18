<?php

namespace App\Models;

use App\Database;

class EmailVerify extends Database
{
    public static $table = 'email_verify';

    public static function create(array $newData): int
    {
        if (isset($newData['create_at'])) unset($newData['create_at']);
        if (isset($newData['create_by'])) unset($newData['create_by']);
        if (isset($newData['update_at'])) unset($newData['update_at']);
        if (isset($newData['update_by'])) unset($newData['update_by']);

        $table = self::$table;
        $sql = "INSERT INTO $table" . parent::buildInsertData($newData);
        return parent::buildCreate($sql, $newData);
    }

    public static function findEmail(array $conditions)
    {
        $table = self::$table;
        $sql = "SELECT * FROM $table WHERE email = ? AND verified = '0' AND expired_at > NOW()";
        return parent::buildFindOne($sql, $conditions);
    }

    public static function findToken(array $conditions)
    {
        $table = self::$table;
        $sql = "SELECT * FROM $table WHERE token = ? AND verified = '0' AND expired_at > NOW()";
        return parent::buildFindOne($sql, $conditions);
    }

    public static function verifyEmail(array $conditions)
    {
        $table = self::$table;
        $sql = "UPDATE $table SET verified = '1'" . parent::buildWhereClause($conditions) . " AND verified = '0' AND expired_at > NOW()";
        return parent::buildUpdate($sql, $conditions, []);
    }
}
