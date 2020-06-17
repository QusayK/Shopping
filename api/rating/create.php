<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/rating.php';

    $database = new Database();
    $db = $database->connect();

    $rating = new Rating($db);


    if (isset($_POST['rating']) && ($_POST['rating'] != '')) {
        $rating->user_id = $_SESSION['login'];
        $rating->product_id = $_POST['product_id'];
        $rating->rating = $_POST['rating'];

        if ($rating->create()) {

            echo 1;
        } else {

            echo 0;
        }
    } else {

        echo 0;
    }
?>