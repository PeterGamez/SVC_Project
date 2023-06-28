<?php

use App\Models\Bank;

$result = Bank::find();

$data = json_encode($result);
$data = '{"data":' . $data . '}';
echo $data;
