<?php
$product_id = $_GET['product_id'];
session_start();

if (!array_key_exists('products', $_SESSION) {
     $_SESSION['products'] = []
}

$_SESSION['products'][$product_id] = array_key_exists($product_id, $_SESSION['products']) ? $_SESSION['products'][$product_id] + 1 : 1;

header('Location: catalog.php');