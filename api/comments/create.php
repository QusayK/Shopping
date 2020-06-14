<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
 
    include_once '../../config/database.php';
    include_once '../../models/comments.php';

    $database = new Database();
    $db = $database->connect();

    $comments = new Comments($db);

    if(isset($_POST['comment']) && $_POST['comment'] != '') {
        $comments->user_id = $_SESSION['login'];
        $comments->product_id = $_POST['product_id'];
        $comments->comment = $_POST['comment'];

        if ($comments->create()) {

            echo json_encode(
                array('message' => 'Comment created')
            );
        } else {
            
            echo json_encode(
                array('message' => 'Comment not created')
            );
        }
    } else {
        echo 0;
    }
?>