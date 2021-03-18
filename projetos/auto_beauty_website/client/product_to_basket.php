<?php

require '../db_connection.php';
require '../protection.php';
protection();

/////// Criar tabela basket na bd se esta ainda não existir ////////////////////////////////////////////////////////////////////////////////////////

$basket_table = "CREATE TABLE IF NOT EXISTS basket (
    item_id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_id VARCHAR(45) NOT NULL,
    rim_id INT(20) UNSIGNED NOT NULL,
    CONSTRAINT client_FK FOREIGN KEY (client_id) REFERENCES users(email),
    CONSTRAINT rim_FK FOREIGN KEY (rim_id) REFERENCES rims(id),
    quantity INT(3) UNSIGNED NOT NULL
)";

$pdo -> query($basket_table);

/////// Adicionar produto selecionado à tebela basket //////////////////////////////////////////////////////////////////////////////////////////////

$client_id = filter_input(INPUT_GET, 'username');
$rim_id = filter_input(INPUT_GET, 'id');
$min_quantity = '1';

$select_basket = "SELECT * FROM basket WHERE client_id = '$client_id' AND rim_id = '$rim_id'";
$selected_basket = $pdo -> query($select_basket);
$count = $selected_basket->rowCount();

if ($count === 0) {
    $new_basket_item = "INSERT INTO basket (client_id, rim_id, quantity) VALUES ('$client_id', '$rim_id', '$min_quantity')";
} else {
    foreach ($selected_basket -> fetchAll() as $row) {
        $quantity = $row['quantity'];
    }
    $quantity_updated = $quantity + 1;
    $new_basket_item = "UPDATE basket SET quantity = '$quantity_updated' WHERE client_id = '$client_id' AND rim_id = '$rim_id'";
}
$basket_result = $pdo -> query($new_basket_item);

header('location: client_rims.php?username='.$client_id.'');