<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/rating.php';

    $database = new Database();
    $db = $database->connect();

    $rating = new Rating($db);

    $rating->product_id = isset($_GET['id']) ? $_GET['id'] : die();
    $result = $rating->read();

    $num = $result->rowCount();

    if ($num > 0) {

        $rating_arr = array();
        $rating_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            extract($row);

            $rating_item = array(
                'product_id' => $product_id,
                'rating' => $rating,
                'ratings_num' => $ratings_num
            );

            array_push($rating_arr['data'], $rating_item);
        }

        echo json_encode($rating_arr);
    } else {

        echo json_encode(
            array('message' => 'Not rated yet')
        );
    }
?>