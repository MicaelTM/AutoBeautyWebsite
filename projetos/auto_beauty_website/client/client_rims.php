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

$client_id = filter_input(INPUT_GET, 'username');

?>

<html>
<head>
    <title> Jantes </title>
    <link rel="stylesheet" href="../css/client_rims.css">
    <script src="../js/side_navigation.js"></script>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="#" class="closebtn" onclick="closeNav()">×</a>
        <a href="client_homepage.php?username=<?php echo $client_id ?>">Início</a>
        <a href="client_contacts.php?username=<?php echo $client_id ?>">Contactos</a>
        <a href="../logout.php">Sair</a>
    </div>
    <div id="main">
        <button class="openbtn" onclick="openNav()">☰ Menu</button>
    </div>
    
    <div class="position">
        <a href="client_basket.php?username=<?php echo $client_id ?>" class="shopping_bag_button"><img src="../icons/bag_button.png"></a>
    </div>
    
    <h1 class="page_title">Jantes</h1>
    <div class="top_image">
        <img src="../images/admin-client_rims.png">
    </div>
    
    <!-- /////// Pedaço de código que permite apresentar os dados que vêm da bd em gridview //////////////////////////////////////////////////// -->

    <?php
    
    if ($count === 0) {
        echo '<div class="empty_client_rims_warning">'
                .'<text>Aguarde, serão adicionados aqui os nossos produtos. Brevemente!</text>'
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
            echo '<br><div class="centering"><a href="product_to_basket.php?id='.$id.'&username='.$client_id.'" class="shopping_button"><img src="../icons/shopping_button.png"></a></div>';
            echo '</td>';
            $i++; // Incrementa o contador de anuncios
        }
        echo '</table>';
    }
    ?>
</body>
</html>