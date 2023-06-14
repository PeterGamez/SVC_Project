<?php
class Login extends Database
{
    static function get_user($user)
    {
        $conditions = ['username' => $user, 'email' => $user];
        $sql = "SELECT * FROM account" . parent::buildWhereClause($conditions, 'OR');
        return parent::buildFindOne($sql, $conditions);
    }
    static function get_email($email)
    {
        $conditions = ['email' => $email];
        $sql = "SELECT * FROM account" . parent::buildWhereClause($conditions);
        return parent::buildFindOne($sql, $conditions);
    }
    static function set_session($data)
    {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['user_username'] = $data['username'];
        $_SESSION['user_avatar'] = isset($data['avatar']) ? $data['avatar'] : resource('images/logo-1000.png', true);
        $_SESSION['user_role'] = $data['role'];
    }
    static function set_avatar($id, $avatar)
    {
        $conditions = ['id' => $id];
        $newData = ['avatar' => $avatar];
        return parent::buildUpdate('account', $conditions, $newData);
    }
}
