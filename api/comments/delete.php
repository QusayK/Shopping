<?php
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: DELETE');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/comments.php';

    $database = new Database();
    $db = $database->connect();

    $comments = new Comments($db);

    $data = json_decode(file_get_contents("php://input"));

    $comments->id = $data->id;

    if ($comments->delete()) {

        echo json_encode(
            array('message' => 'Comment deleted')
        );
    } else {
        
        echo json_encode(
            array('message' => 'Comment not deleted')
        );
    }
?>