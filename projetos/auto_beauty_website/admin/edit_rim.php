<?php

session_start();
require '../db_connection.php';

$id = filter_input(INPUT_GET, 'id');
$submit = filter_input(INPUT_POST, 'submit');

/////// Selecionar imagem antiga do produto ////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset ($id)) {
    $old_image_select = "SELECT image FROM rims WHERE id = '$id'";
    $array_with_image = $pdo -> query($old_image_select);
    
    foreach ($array_with_image -> fetchAll() as $row) {
        $old_image_selected = $row['image'];
    }
}

/////// Quando carregar no botão confirmar v ///////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($submit)) {
    
    /////// Eliminar a imagem antiga da diretoria //////////////////////////////////////////////////////////////////////////////////////////////////
    
    unlink('../rim_images/'.$old_image_selected);
    
    /////// Buscar dados novos do formulário, fazer atualização dos dados na bd e upload na nova imagem na diretoria ///////////////////////////////
    
    $image = $_FILES['image']['name'];
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price');
    $image_folder = "../rim_images/$image";
    
    if (isset($id)) {
        $update_rim = "UPDATE rims SET image = '$image', name = '$name', price = '$price' WHERE id = '$id'";
    }
    $result = $pdo -> query($update_rim);
    
    if($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], $image_folder);
    }
}

header('location: admin_rims.php');