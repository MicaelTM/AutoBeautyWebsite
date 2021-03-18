<?php

session_start();
require '../db_connection.php';

$item_id = filter_input(INPUT_GET, 'item_id');
$client_id = filter_input(INPUT_GET, 'username');

$select_item = "SELECT * FROM basket WHERE item_id = '$item_id'";
$selected_item = $pdo -> query($select_item);

if (isset($item_id)) {
    foreach ($selected_item -> fetchAll() as $row) {
        $quantity = $row['quantity'];
    }
    $quantity_updated = $quantity - 1;
    
    $item_quantity_update = "UPDATE basket SET quantity = '$quantity_updated' WHERE item_id = '$item_id'";
    $quantity_result = $pdo -> query($item_quantity_update);
}

header('location: client_basket.php?username='.$client_id.'');