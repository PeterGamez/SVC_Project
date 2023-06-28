<?php

use App\Models\Whitelist;

$result = Whitelist::find();

$data = json_encode($result);
$data = '{"data":' . $data . '}';
echo $data;
