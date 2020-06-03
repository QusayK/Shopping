<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/classification.php';

    $database = new Database();
    $db = $database->connect();

    $cl = new Classification($db);

    $data = json_decode(file_get_contents("php://input"));

    $cl->id = $data->id;

    if ($cl->delete()) {
       echo json_encode(
           array('message' => 'Product classification was deleted')
       );
    } else {
       echo json_encode(
           array('message' => 'Product classification was not deleted')
       );
    }
?>