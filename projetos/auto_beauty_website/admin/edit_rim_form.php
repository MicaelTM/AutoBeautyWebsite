<?php

require '../db_connection.php';
require '../protection.php';
protection();

$id = filter_input(INPUT_GET, 'id');

if (isset($id)){
    $select_rims = "SELECT image, name, price FROM rims WHERE id=$id";
    $selected_rims = $pdo -> query($select_rims);
	
    foreach ($selected_rims -> fetchAll() as $row) {
        $action = '?id='.$id;
        $image = $row['image'];
        $name = $row['name'];
        $price = $row['price'];
    }
}

?>

<html>
<head>
    <title> Editar Jante </title>
    <link rel="stylesheet" type="text/css" href="../css/edit_rim_form.css">
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
    
    <h1 class="page_title">Editar Jante <?php echo $name ?></h1>
    <div class="top_image">
        <img src="../images/edit_rim_form.png">
    </div>
    
    <div class="main1">
        <form class="form1" method="post" action="edit_rim.php<?php echo $action ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <div class="inputFile1" placeholder="Pode carregar aqui a sua imagem nova">
                            <input id="inputFile2" type="file" name="image" onchange="show_image_name()" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="file_text">Imagem atual: </span><input id="outputFile" type="text" value="<?php echo $image ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="inputs" type="text" value="<?php echo $name ?>" name="name" minlength="3" maxlength="15" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="inputs" type="text" value="<?php echo $price ?> €" name="price" minlength="1" maxlength="3" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="submit" type="submit" name="submit">Atualizar</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>