<?php

use App\Models\Whitelist;

$data = Whitelist::find()
    ->select('tag', 'name', 'id_firstname', 'id_lastname')
    ->get();

$dataArray = array();
for ($i = 0; $i < count($data); $i++) {
    $dataArray[$i] = array(
        $data[$i]['tag'],
        $data[$i]['name'],
        $data[$i]['id_firstname'] . ' ' . $data[$i]['id_lastname'],
    );
}

$response = json_encode($dataArray);
$response = '{"data":' . $response . '}';
echo $response;
