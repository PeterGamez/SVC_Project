<?php

use App\Class\Api;
use App\Models\Blacklist;

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (empty($data['query'])) {
    echo Api::error_400();
    exit;
}
$data = Blacklist::find()
    ->select('name')
    ->where('name', '%' . $data['query'] . '%', 'LIKE')
    ->limit(10)
    ->get();

$dataArray = array();
for ($i = 0; $i < count($data); $i++) {
    $dataArray[$i] = $data[$i]['name'];
}

$respond = array(
    'data' => $dataArray
);

echo json_encode($respond);
