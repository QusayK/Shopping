<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/product.php';

    $database = new Database();
    $db = $database->connect();

    $product = new Product($db);

    $product->id = isset($_GET['id']) ? $_GET['id'] : die();

    $product->read_single();

    $product_arr = array(
        'id' => $product->id,
        'type' => $product->type,
        'price' => $product->price,
        'image' => $product->image
    );

    print_r(json_encode($product_arr));
?>