<?php

require '../protection.php';
protection();

?>

<html>
<head>
    <title> Adicionar Jante </title>
    <link rel="stylesheet" type="text/css" href="../css/add_rim_form.css">
    <script src="../js/side_navigation.js"></script>
    <script src="../js/show_image_name.js"></script>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="#" class="closebtn" onclick="closeNav()">×</a>
        <a href="admin_homepage.php">Início</a>
        <a href="#" onclick="toogleSubMenu()">Produtos</a>
        <div id="subContentMenu">
            <a href="admin_rims.php">Jantes</a>
        </div>
        <a href="../logout.php">Sair</a>
    </div>
    <div id="main">
        <button class="openbtn" onclick="openNav()">☰ Menu</button>
    </div>
    
    <h1 class="page_title">Adicionar Jante</h1>
    <div class="top_image">
        <img src="../images/add_rim_form.png">
    </div>
    
    <div class="main1">
        <form class="form1" method="post" action="add_rim.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <div class="inputFile1" placeholder="Carregue aqui a sua imagem">
                            <input id="inputFile2" type="file" name="image" onchange="show_image_name()" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="file_text">Imagem carregada: </span><input id="outputFile" type="text" disabled>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="inputs" type="text" placeholder="Nome" name="name" minlength="3" maxlength="15" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="inputs" type="text" placeholder="Preço (€)" name="price" minlength="1" maxlength="3" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="submit" type="submit" name="submit">Confirmar</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>