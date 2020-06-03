<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/classification.php';

    $database = new Database();
    $db = $database->connect();

    $cl = new Classification($db);

    $cl->id = isset($_GET['id']) ? $_GET['id'] : die();

    $cl->read();

    $cl_arr = array(
        'id' => $cl->id,
        'favorite' => $cl->favorite,
        'basket' => $cl->basket,
        'purchased' => $cl->purchased  
    );

    print_r(json_encode($cl_arr));
?>