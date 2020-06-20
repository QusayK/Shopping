<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/classification.php';

    $database = new Database();
    $db = $database->connect();

    $cl = new Classification($db);

    $cl->id = isset($_GET['id']) ? $_GET['id'] : die();

    $cl->uid = 1;

    if ($cl->remove_from_favorites()) {

        echo 1;
    } else {

        echo 0;
    }
?>