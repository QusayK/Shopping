<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/rating.php';

    $database = new Database();
    $db = $database->connect();

    $rating = new Rating($db);

    $rating->user_id = $_SESSION['login'];
    $rating->product_id = isset($_GET['pid']) ? $_GET['pid'] : die();
    $rating->read_single();

    $rating_arr = array(
        'user_id' => $rating->user_id,
        'product_id' => $rating->product_id,
        'rating' => $rating->rating
    );

    print_r(json_encode($rating_arr));
?>