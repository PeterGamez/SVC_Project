<?php

use App\Class\Api;

header('Content-Type: application/json; charset=UTF-8');

array_shift($agent_request);

$version = isset($agent_request[0]) ? $agent_request[0] : null;

array_shift($agent_request);

if (empty($version)) {
    echo Api::error_404('API Version Not Found');
    exit;
}

if ($version == 'v1') {
    if (empty($agent_request[0])) {
        echo Api::error_404('API Not Found');
        exit;
    }

    if ($agent_request[0] == 'whitelist') {
        if ($agent_request[1] == 'list') {
            return api('GET', 'v1.whitelist.list');
        }
    } else if ($agent_request[0] == 'blacklist') {
        if ($agent_request[1] == 'search') {
            return api('POST', 'v1.blacklist.search');
        }
    }
}

echo Api::error_404('API Not Found');
