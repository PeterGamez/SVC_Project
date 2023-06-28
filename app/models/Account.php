<?php

namespace App\Models;

use App\Database;

class Account extends Database
{
    public static $table = 'account';

    public static function register(array $newData)
    {
        $table = self::$table;

        $sql = "INSERT INTO $table" . parent::buildInsertData($newData);
        $insert_id = parent::buildCreate($sql, $newData);

        $sql = "UPDATE $table SET create_at = NOW(), create_by = ?, update_at = NOW(), update_by = ? WHERE id = ?";
        return parent::buildUpdate($sql, [$insert_id, $insert_id, $insert_id], []);
    }
}
