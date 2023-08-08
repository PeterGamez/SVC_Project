<?php

session_start();

if (empty($_SESSION['id'])) {
    $_SESSION['id'] = session_id();
    $_SESSION['login'] = false;
    $_SESSION['user_role'] = 'visitor';
}

require_once dirname(__DIR__) . '/app/function.php';

require_once dirname(__DIR__) . '/database/autoload.php';

$Models = scandir(dirname(__DIR__) . '/app/models'); // ไฟล์ทั้งหมดในโฟลเดอร์
foreach ($Models as $key => $value) {
    if ($value != '.' && $value != '..' && substr($value, -4) == '.php') {
        require_once dirname(__DIR__) . '/app/models/' . $value;
    }
}

$Class = scandir(dirname(__DIR__) . '/app/class'); // ไฟล์ทั้งหมดในโฟลเดอร์
foreach ($Class as $key => $value) {
    if ($value != '.' && $value != '..' && substr($value, -4) == '.php') {
        require_once dirname(__DIR__) . '/app/class/' . $value;
    }
}

$agent = $_SERVER['HTTP_USER_AGENT'];
$agent_url = $_SERVER['REQUEST_URI'];
$agent_path = parse_url($agent_url, PHP_URL_PATH);
$agent_request = explode('/', $agent_path);