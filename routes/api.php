<?php

header('Content-Type: application/json');

array_shift($agent_request);

$version = isset($agent_request[0]) ? $agent_request[0] : null;

array_shift($agent_request);

if (empty($version)) {
    $error_404 = [
        'status' => 404,
        'message' => 'API Version Not Found'
    ];
    http_response_code(404);
    echo json_encode($error_404, JSON_PRETTY_PRINT);
    exit;
}

if ($version == 'v1') {
    if (empty($agent_request[0])) {
        $error_404 = [
            'status' => 404,
            'message' => 'API Not Found'
        ];
        http_response_code(404);
        echo json_encode($error_404, JSON_PRETTY_PRINT);
        exit;
    }

    if ($agent_request[0] == 'whitelist') {
        if ($agent_request[1] == 'list') {
            return api('v1.whitelist.list');
        }
    }
}

$error_404 = [
    'status' => 404,
    'message' => 'Not Found'
];
http_response_code(404);
echo json_encode($error_404, JSON_PRETTY_PRINT);
