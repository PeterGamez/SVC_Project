<?php
$result = Account::find();

foreach ($result as $key => $value) {
    unset($result[$key]['password']);
}

$data = json_encode($result);
$data = '{"data":' . $data . '}';
echo $data;
