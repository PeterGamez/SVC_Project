<?php

require_once __ROOT__ . '/app/function.php';

require_once __ROOT__ . '/database/autoload.php';

$Models = scandir(__ROOT__ . '/app/models'); // ไฟล์ทั้งหมดในโฟลเดอร์
foreach ($Models as $key => $value) {
    if ($value != '.' && $value != '..' && substr($value, -4) == '.php') {
        require_once __ROOT__ . '/app/models/' . $value;
    }
}

$Class = scandir(__ROOT__ . '/app/class'); // ไฟล์ทั้งหมดในโฟลเดอร์
foreach ($Class as $key => $value) {
    if ($value != '.' && $value != '..' && substr($value, -4) == '.php') {
        require_once __ROOT__ . '/app/class/' . $value;
    }
}

$agent = $_SERVER['HTTP_USER_AGENT'];
$agent_url = $_SERVER['REQUEST_URI'];
$agent_path = parse_url($agent_url, PHP_URL_PATH);
$agent_request = explode('/', $agent_path);

require_once __ROOT__ . '/routes/web.php';
