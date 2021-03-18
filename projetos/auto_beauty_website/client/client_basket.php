<?php

require '../db_connection.php';
require '../protection.php';
protection();

$client_id = filter_input(INPUT_GET, 'username');

/////// Criar tabela rims na bd se esta ainda não existir //////////////////////////////////////////////////////////////////////////////////////////

$rims_table = "CREATE TABLE IF NOT EXISTS rims (
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    name VARCHAR(10) NOT NULL,
    price INT(3) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$pdo -> query($rims_table);

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

/////// Selecionar items do basket que pertencem ao utilizador atual ///////////////////////////////////////////////////////////////////////////////

$select_basket = "SELECT * FROM basket WHERE client_id = '$client_id'";
$selected_basket = $pdo -> query($select_basket);
$count = $selected_basket -> rowCount();

?>

<html>
<head>
    <title> Cesto </title>
    <link rel="stylesheet" type="text/css" href="../css/client_basket.css">
    <script src="../js/side_navigation.js"></script>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="#" class="closebtn" onclick="closeNav()">×</a>
        <a href="client_homepage.php?username=<?php echo $client_id ?>">Início</a>
        <a href="#" onclick="toogleSubMenu()">Produtos</a>
        <div id="subContentMenu">
            <a href="client_rims.php?username=<?php echo $client_id ?>">Jantes</a>
        </div>
        <a href="client_contacts.php?username=<?php echo $client_id ?>">Contactos</a>
        <a href="../logout.php">Sair</a>
    </div>
    <div id="main">
        <button class="openbtn" onclick="openNav()">☰ Menu</button>
    </div>

    <h1 class="page_title">Cesto</h1>
    <div class="top_image">
        <img src="../images/client_basket.png">
    </div>
    
    
    <?php
        if ($count === 0) {
            echo '<div class="empty_basket_warning">'
                    .'<text>Ainda não existem produtos adicionados ao cesto.</text>'
                .'</div>';
        } else {
            ?>
                <table class="basket_products">
                    <th class="first_th">Produto</th>
                    <th class="second_th">Nome</th>
                    <th class="thirth_th">Preço</th>
                    <th class="fourth_th">Quantidade</th>
                    <th class="last_th"></th>
                    <?php
                    foreach ($selected_basket -> fetchAll() as $row) {
                        $item_id = $row['item_id'];
                        $rim_id = $row['rim_id'];
                        $quantity = $row['quantity'];

                        $select_rim = "SELECT * FROM rims WHERE id = '$rim_id'";
                        $selected_rim = $pdo -> query($select_rim);

                        foreach ($selected_rim -> fetchAll() as $row) {
                            $image = $row['image'];
                            $name = $row['name'];
                            $price = $row['price'];
                        }

                        echo '<tr>';
                        echo '<td class="item_image"><img src="../rim_images/'.$image.'"></td>';
                        echo '<td>'.$name.'</td>';
                        echo '<td>'.$price.' €</td>';
                        echo '<td class="minus_plus_buttons">'
                                .'<a href="minus_basket.php?item_id='.$item_id.'&username='.$client_id.'">'
                                    .'<img src="../icons/basket_minus_button.png">'
                                .'</a>'.$quantity.''
                                .'<a href="plus_basket.php?item_id='.$item_id.'&username='.$client_id.'">'
                                    .'<img src="../icons/basket_plus_button.png">'
                                .'</a>'
                            .'</td>';
                        echo '<td class="remove_button">'
                                .'<a href="remove_basket_item.php?item_id='.$item_id.'&username='.$client_id.'">'
                                    .'<img src="../icons/basket_delete_button.png">'
                                .'</a>'
                            .'</td>';
                        echo '</tr>';
                    }
                    ?>
                    <th colspan="5" class="basket_products_bottom"></th>
                </table>
            <?php
        }
    ?>
</body>
</html>