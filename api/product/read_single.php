<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../model/product.php';

    $database = new Database();
    $db = $database->connect();

    $product = new Product($db);

    $product->id = isset($_GET['id']) ? $_GET['id'] : die();

    $product->read_single();

    $product_arr = array(
        'id' => $product->id,
        'type' => $product->type,
        'price' => $product->price,
        'rating' => $product->rating
    );

    print_r(json_encode($product_arr));
?>