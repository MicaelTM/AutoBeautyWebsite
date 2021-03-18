<?php
?>

<html>
<head>
    <title> Iniciar Sessão </title>
    <link rel="stylesheet" type="text/css" href="css/login_form.css">
</head>
<body>
    <div class="main">
        <p class="sign" align="center">Iniciar sessão</p>
        <form class="form1" method="post" action="verify_login.php">
            <table>
                <tr>
                    <td> <input class="inputs" type="text" placeholder="Email" name="email" maxlength="45" required> </td>
                </tr>
                <tr>
                    <td> <input class="inputs" type="password" placeholder="Palavra-passe" name="password" minlength="8" maxlength="20" required> </td>
                </tr>
                <tr>
                    <td> <button class="submit" type="submit">Entrar</button> </td>
                </tr>
                <tr>
                    <td> <p class="account"> <a href="registration_form.php">Não tem conta?</p> </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>