<?php
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
 
    include_once '../../config/database.php';
    include_once '../../models/comments.php';

    $database = new Database();
    $db = $database->connect();

    $comments = new Comments($db);

    $data = json_decode(file_get_contents("php://input"));

    $comments->user_id = $data->user_id;
    $comments->product_id = $data->product_id;
    $comments->comment = $data->comment;

    if ($comments->create()) {

        echo json_encode(
            array('message' => 'Comment created')
        );
    } else {
        
        echo json_encode(
            array('message' => 'Comment not created')
        );
    }
?>