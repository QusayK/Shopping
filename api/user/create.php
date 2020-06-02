<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/user.php';

    $database = new Database();
    $db = $database->connect();

    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $user->name = $data->name;
    $user->email = $data->email;
    $user->password = $data->password;

    if ($user->create()) {

        echo json_encode(
            array('message' => 'User created')
        );
    } else {
        
        echo json_encode(
            array('message' => 'User not created')
        );
    }
?>