<?php

use App\Class\App;

header('Content-Type: application/json');

array_shift($agent_request);

$version = isset($agent_request[0]) ? $agent_request[0] : null;

array_shift($agent_request);

if (empty($version)) {
    echo App::error_404('API Version Not Found');
    exit;
}

if ($version == 'v1') {
    if (empty($agent_request[0])) {
        echo App::error_404();
        exit;
    }

    if ($agent_request[0] == 'whitelist') {
        if ($agent_request[1] == 'list') {
            return api('GET', 'v1.whitelist.list');
        }
    }
}

echo App::error_404();