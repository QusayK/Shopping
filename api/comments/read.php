<?php
    header('Access-Controrl-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/comments.php';

    $database = new Database();
    $db = $database->connect();

    $comments = new Comments($db);

    $comments->product_id = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $comments->read();
    $num = $result->rowCount();

    $comment_arr = array();
    $comments_arr['data'] = array();

    if ($num > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            
            $comments_items = array(
                'id' => $id,
                'user_id' => $user_id,
                'product_id' => $product_id,
                'comment' => $comment
            );

            array_push($comments_arr['data'], $comments_items);
        }

        echo json_encode($comments_arr);
    } else {

        echo json_encode(
            array('message' => 'No comments found')
        );
    }
?>