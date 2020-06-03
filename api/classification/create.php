<?php
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
 
     include_once '../../config/database.php';
     include_once '../../models/classification.php';
 
     $database = new Database();
     $db = $database->connect();

     $cl = new Classification($db);

     $data = json_decode(file_get_contents("php://input"));

     $cl->id = $data->id;
     $cl->favorite = $data->favorite;
     $cl->basket = $data->basket;
     $cl->purchased = $data->purchased;

     if ($cl->create()) {
        echo json_encode(
            array('message' => 'Product was classified')
        );
     } else {
        echo json_encode(
            array('message' => 'Product was not classified')
        );
     }
?>