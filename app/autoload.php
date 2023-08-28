<?php

require_once __ROOT__ . '/app/function.php';

require_once __ROOT__ . '/database/autoload.php';

loaddir(__ROOT__ . '/app/class');
loaddir(__ROOT__ . '/app/controllers');
loaddir(__ROOT__ . '/app/models');

$agent = $_SERVER['HTTP_USER_AGENT'];
$agent_url = $_SERVER['REQUEST_URI'];
$agent_path = parse_url($agent_url, PHP_URL_PATH);
$agent_request = explode('/', $agent_path);

require_once __ROOT__ . '/routes/web.php';
