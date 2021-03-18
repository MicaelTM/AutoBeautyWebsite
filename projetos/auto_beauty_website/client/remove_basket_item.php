<?php

session_start();
require '../db_connection.php';

$item_id = filter_input(INPUT_GET, 'item_id');
$client_id = filter_input(INPUT_GET, 'username');

if (isset($item_id)) {
    $delete_item = "DELETE FROM basket WHERE item_id = '$item_id'";
}
$result = $pdo -> query($delete_item);

header('location: client_basket.php?username='.$client_id.'');