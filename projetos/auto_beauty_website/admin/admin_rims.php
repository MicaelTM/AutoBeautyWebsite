<?php

require '../db_connection.php';
require '../protection.php';
protection();

/////// Criar tabela rims na bd se esta ainda não existir //////////////////////////////////////////////////////////////////////////////////////////

$rims_table = "CREATE TABLE IF NOT EXISTS rims (
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    name VARCHAR(10) NOT NULL,
    price INT(3) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$pdo -> query($rims_table);

/////// Selecionar jantes da bd ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$select_rims = "SELECT id, image, name, price FROM rims";
$selected_rims = $pdo -> query($select_rims);
$count = $selected_rims -> rowCount();

?>

<html>
<head>
    <title> Jantes </title>
    <link rel="stylesheet" href="../css/admin_rims.css">
    <script src="../js/side_navigation.js"></script>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="#" class="closebtn" onclick="closeNav()">×</a>
        <a href="admin_homepage.php">Início</a>
        <a href="../logout.php">Sair</a>
    </div>
    <div id="main">
        <button class="openbtn" onclick="openNav()">☰ Menu</button>
    </div>
    
    <h1 class="page_title">Jantes <a href="add_rim_form.php" class="plus_button"><img src="../icons/plus_button.png"></a></h1>
    <div class="top_image">
        <img src="../images/admin-client_rims.png">
    </div>
    
    <!-- /////// Pedaço de código que permite apresentar os dados que vêm da bd em gridview //////////////////////////////////////////////////// -->

    <?php
    
    if ($count === 0) {
        echo '<div class="empty_admin_rims_warning">'
                .'<text>Carregue no + acima para adicionar um novo produto ao seu website.</text>'
            .'</div>';
    } else {
        echo '<table class="rims_table">';
        $i = 0;
        foreach ($selected_rims -> fetchAll() as $row) {
            // Faz uma nova linha após 3 anúncios de jantes
            if($i%3 == 0) {
                if($i > 0) {
                   // E apenas a fecha se não for o primeiro anuncio
                   echo '</tr>';
                }
                echo '<tr>';
            }

            $id = $row['id'];
            $image = $row['image'];
            $name = $row['name'];
            $price = $row['price'];

            echo '<td class="table_td">';
            echo '<img src="../rim_images/'.$image.'"><br>';
            echo '<br><div class="centering"><span class="table_title">Nome: </span>';
            echo '<span class="table_data">'.$name.'</span>';
            echo '<span class="table_title">Preço: </span>';
            echo '<span class="table_data">'.$price.' €</span></div>';
            echo '<br><div class="centering"><a href="edit_rim_form.php?id='.$id.'" class="edit_button"><img src="../icons/edit_button.png"></a>';
            echo '<a href="delete_rim.php?id='.$id.$image.'" class="delete_button"><img src="../icons/delete_button.png"></div></a>';
            echo '</td>';
            $i++; // Incrementa o contador de anuncios
        }
        echo '</table>';
    }
    ?>
</body>
</html>