<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/product.php';

    $database = new Database();
    $db = $database->connect();

    $product = new Product($db);

    $data = json_decode(file_get_contents("php://input"));

    $product->id = $data->id;

    if ($product->delete()) {
        echo json_encode(
            array('message' => 'Product deleted')
        );
    } else {

        echo json_encode(
            array('message' => 'Product not deleted')
        );
    }
?>