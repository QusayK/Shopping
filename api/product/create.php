<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/product.php';

    $database = new Database();
    $db = $database->connect();

    $product = new Product($db);

    $data = json_decode(file_get_contents("php://input"));

    $product->type = $data->type;
    $product->price = $data->price;
    $product->image = $data->price;

    if ($product->create()) {

        echo json_encode(
            array('message' => 'Product created')
        );
    } else {

        echo json_encode(
            array('message' => 'Product not created')
        );
    }
?>