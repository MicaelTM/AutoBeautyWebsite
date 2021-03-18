<?php

require '../db_connection.php';
require '../protection.php';
protection();

$client_id = filter_input(INPUT_GET, 'username');

?>

<html>
<head>
    <title> Contactos </title>
    <link rel="stylesheet" type="text/css" href="../css/client_contacts.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9reOyIC42nZ1v7l0FQbe65OP2Col3wc8"></script>
    <script src="../js/google_map.js"></script>
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
        <a href="../logout.php">Sair</a>
    </div>
    <div id="main">
        <button class="openbtn" onclick="openNav()">☰ Menu</button>
    </div>
    
    <h1 class="page_title">Contacta-nos</h1>
    <div class="top_image">
        <img src="../images/client_contacts.png">
    </div>
    
    <div class="centering">
        <div class="main_titles"> Fale connosco </div>
        <div>
            <text class="second_titles"> Precisa de Ajuda? </text><br>
            <text class="texts"> Fale agora com um dos nossos especialista <br>que o ajudará a tirar todas as suas dúvidas. </text><br><br>
            <text class="second_titles"> Telefone: </text>
            <text class="texts"> 700 700 700 </text><br><br>
            <text class="second_titles"> Email: </text>
            <text class="texts"> autobeauty@hotmail.com </text>
        </div>
        
        <div class="main_titles"> Onde nos encontrar </div>
        <div id="map"></div>
        <div>
            <text class="second_titles"> Morada: </text><br>
            <text class="texts"> Auto Beauty, Lda </text><br>
            <text class="texts"> 722 E Kensington Rd, Los Angeles </text><br>
            <text class="texts"> CA 90026, Estados Unidos </text><br>
        </div>
    </div>
</body>
</html>