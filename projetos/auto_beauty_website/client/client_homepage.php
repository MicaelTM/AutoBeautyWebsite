<?php

require '../db_connection.php';
require '../protection.php';
protection();

$welcome_text = $_SESSION['first_name'];

$client_id = filter_input(INPUT_GET, 'username');

?>

<html>
<head>
    <title> Início </title>
    <link rel="stylesheet" type="text/css" href="../css/client_homepage.css">
    <script src="../js/side_navigation.js"></script>
    <script src="../js/slideshow.js"></script>
    <script src="../js/clock.js"></script>
</head>
<body onload="slide(); startTime()">
    <div id="mySidebar" class="sidebar">
        <a href="#" class="closebtn" onclick="closeNav()">×</a>
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
    
    <div class="position">
        <a href="client_basket.php?username=<?php echo $client_id ?>" class="shopping_bag_button"><img src="../icons/bag_button.png"></a>
    </div>
    
    <div class="slideshow">
        <img name="slide" src="">
    </div>
    
    <div class="welcome_website_block">
        <div class="spacing_main_text">Bem-vindo(a) <?php echo $welcome_text ?></div>
        <div id="clock_text1">
            <text id="clock_text2">Hora local:</text>
            <div id="clock_text3"></div>
        </div>
    </div>
</body>
</html>