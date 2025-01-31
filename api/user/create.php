<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/user.php';

    $database = new Database();
    $db = $database->connect();

    $user = new User($db);

    if (($_POST['name'] != "") && ($_POST['email'] != "") && ($_POST['password'] != "")) {

        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        if ($user->create()) {

            $_SESSION['login'] = $user->id;
            
            echo 'true';
        } else {
            
            echo 'false';
        }
   } else {

        echo 'false';
   }
?>