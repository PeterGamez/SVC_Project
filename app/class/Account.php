<?php
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

    public static function set_session($data)
    {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['user_username'] = $data['username'];
        $_SESSION['user_avatar'] = isset($data['avatar']) ? $data['avatar'] : resource('images/logo-1000.png', true);
        $_SESSION['user_role'] = $data['role'];
    }
}
