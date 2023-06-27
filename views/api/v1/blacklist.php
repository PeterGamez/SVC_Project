<?php
$result = Blacklist::find();

$data = json_encode($result);
$data = '{"data":' . $data . '}';
echo $data;
