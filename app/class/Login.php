<?php
class Login
{
    static function get_user($user)
    {
        $sql = "SELECT * FROM account WHERE username = ? OR email = ?";
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $user, $user);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result[0] ?? null;
    }
    static function get_email($email)
    {
        $sql = "SELECT * FROM account WHERE email = ?";
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result[0] ?? null;
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
        $sql = "UPDATE account SET avatar = ? WHERE id = ?";
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $avatar, $id);
        $stmt->execute();
        $stmt->close();
    }
}
