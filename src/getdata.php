<?php
header('Content-Type: application/json; charset=utf-8');

$json = file_get_contents('data.json');
echo $json;
?>