<?php

session_start();
require '../db_connection.php';

$id = filter_input(INPUT_GET, 'id');

/////// Selecionar imagem do produto a eliminar ////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset ($id)) {
    $image_select = "SELECT image FROM rims WHERE id = '$id'";
    $array_with_image = $pdo -> query($image_select);
    
    foreach ($array_with_image -> fetchAll() as $row) {
        $image_to_delete = $row['image'];
    }
}

/////// Eliminar a imagem do produto atual na diretoria ////////////////////////////////////////////////////////////////////////////////////////////

unlink('../rim_images/'.$image_to_delete);

/////// Eliminar produto(jante) da bd //////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($id)) {
    $delete_rim = "DELETE FROM rims WHERE id = '$id'";
}
$result = $pdo -> query($delete_rim);

header('location: admin_rims.php');