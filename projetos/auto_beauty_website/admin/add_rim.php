<?php

session_start();
require '../db_connection.php';

$submit = filter_input(INPUT_POST, 'submit');

if(isset($submit)) {
    $image = $_FILES['image']['name'];
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price');
    $image_folder = "../rim_images/$image";

    $add_rim = "INSERT INTO rims (image, name, price) VALUES ('$image', '$name', '$price')";
    $result = $pdo -> query($add_rim);
    
    if($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], $image_folder);
    }
}

header('location: admin_rims.php');