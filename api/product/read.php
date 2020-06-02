<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/product.php';

    $database = new Database();
    $db = $database->connect();

    $product = new Product($db);
    $result= $product->read();

    $num = $result->rowCount();

    if ($num > 0) {

        $product_arr = array();
        $product_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            extract($row);

            $product_item = array(
                'id' => $id,
                'type' => $type,
                'price' => $price
            );

            array_push($product_arr['data'], $product_item);
        }

        echo json_encode($product_arr);
    } else {

        echo json_encode(
            array('message' => 'No products found')
        );
    }
?>