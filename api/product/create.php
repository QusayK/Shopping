<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/product.php';

    $database = new Database();
    $db = $database->connect();

    $product = new Product($db);

    //if (isset($_POST)) {

        $filename = $_FILES['file']['name'];

        $product->type = $_POST['type'];
        $product->price = $_POST['price'];
        $product->image = $filename;

        $location = "images/".$filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
        $valid_extensions = array("jpg","jpeg","png");

        if (!in_array(strtolower($imageFileType), $valid_extensions)) {

            $uploadOk = 0;
         }

         if ($uploadOk == 0){

            echo 0;
         } else {
            
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)){

               echo $location;
            } else {

               echo 0;
            }
         }

        if (!$product->create()) {

            echo 0;
        }
    //}
?>