<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/rating.php';

    $database = new Database();
    $db = $database->connect();

    $rating = new Rating($db);

    $data = json_decode(file_get_contents("php://input"));

    $rating->user_id = $data->user_id;
    $rating->product_id = $data->product_id;
    $rating->rating = $data->rating;

    if ($rating->update()) {

        echo json_encode(
            array('message' => 'You updated your rate')
        );
    } else {

        echo json_encode(
            array('mesage' => 'Update rating failed')
        );
    }
?>