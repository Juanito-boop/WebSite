<?php

use cURL\rest;

$data = file_get_contents(filename: 'php://input');
$data = urldecode($data);
parse_str($data, result: $params);

require_once "../../cURL/rest.php";
$curl = rest::getInstance();

$miQuery = $_POST['query'] ?? '';

if (empty($miQuery)) {
    $data = $curl->get("vinos", "select=*");
} else {
    if (is_numeric($miQuery)) {
        $data = $curl->get("vinos", "select=id");
    } else {
        $data = $curl->get("vinos", "select=nombre");
    }
}
var_dump($data);