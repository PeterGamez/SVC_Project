<?php

namespace App\Models;

use Database\Model;

class Account extends Model
{
    public static $table = 'account';

    public static function register(array $newData): int
    {
        $table = self::$table;

        $sql = "INSERT INTO $table" . parent::buildInsertData($newData);
        $insert_id = parent::buildCreate($sql, $newData);

        $sql = "UPDATE $table SET create_at = NOW(), create_by = ?, update_at = NOW(), update_by = ? WHERE id = ?";
        return parent::buildUpdate($sql, [$insert_id], [$insert_id, $insert_id]);
    }

    public static function verifyEmail(int $user_id): int
    {
        $table = self::$table;
        $sql = "UPDATE $table SET email_verified = '1', email_verified_at = NOW(), update_at = NOW(), update_by = ? WHERE id = ?";
        return parent::buildUpdate($sql, [$user_id], [$user_id]);
    }

    public static function registerEmail(int $user_id, string $password = null): int
    {
        $table = self::$table;
        $sql = "UPDATE $table SET email_verified = '1', email_verified_at = NOW(), password = ?, update_at = NOW(), update_by = ? WHERE id = ?";
        return parent::buildUpdate($sql, [$user_id], [$password, $user_id]);
    }

    public static function login(int $user_id): int
    {
        $table = self::$table;
        $sql = "UPDATE $table SET last_login = NOW() WHERE id = ?";
        return parent::buildUpdate($sql, [$user_id], []);
    }
}
