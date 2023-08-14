<?php

use App\Models\Whitelist;

$data = Whitelist::find()->get();

$dataArray = array();
for ($i = 0; $i < count($data); $i++) {
    $dataArray[$i] = array(
        $data[$i]['tag'],
        $data[$i]['name'],
        $data[$i]['id_firstname'] . ' ' . $data[$i]['id_lastname'],
    );
}

$data = json_encode($dataArray);
$data = '{"data":' . $data . '}';
echo $data;
