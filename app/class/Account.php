<?php
class Account
{
   static function get_account_all()
    {
        $sql = "SELECT * FROM account";
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }
}
