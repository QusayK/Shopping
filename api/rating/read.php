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

    $rating_arr = array();
    $rating_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC) {
        $rating_items = array(
            'user_id' => $rating->user_id,
            'product_id' => $rating->porduct_id,
            'rating' => $rating->rating
        )
    }

    print_r(json_encode($rating_arr));
?>