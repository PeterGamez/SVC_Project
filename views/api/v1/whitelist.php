<?php
$result = Whitelist::find();

$data = json_encode($result);
$data = '{"data":' . $data . '}';
echo $data;
