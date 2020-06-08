<?php
    header('Allow-Control-Access-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/product.php';

    $database = new Database();
    $db = $database->connect();

    $product = new Product($db);

    $result = $product->read_favorite();
    $num = $result->rowCount();

    $product_arr = array();

    if ($num > 0) {

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
    
            $product_items = array(
                'id' => $id,
                'type' => $type,
                'price' => $price,
                'image' => $image 
            );

            array_push($product_arr, $product_items);
        }

        echo json_encode($product_arr);
    } else {

        echo json_encode(
            array('message' => 'No products found')
        );
    }
?>