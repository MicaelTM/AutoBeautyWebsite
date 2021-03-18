<?php
?>

<html>
<head>
    <title> Registe-se </title>
    <link rel="stylesheet" type="text/css" href="css/registration_form.css">
</head>
<body>
    <div class="main">
        <p class="sign" align="center">Crie uma conta</p>
        <form class="form1" method="post" action="verify_registration.php">
            <table>
                <tr>
                    <td> <input class="inputs" type="text" placeholder="Primeiro nome" name="first_name" minlength="3" maxlength="10" required> </td>
                </tr>
                <tr>
                    <td> <input class="inputs" type="text" placeholder="Último nome" name="last_name" minlength="3" maxlength="15" required> </td>
                </tr>
                <tr>
                    <td> <input class="inputs" type="text" placeholder="Email" name="email" maxlength="45" required> </td>
                </tr>
                <tr>
                    <td> <input class="inputs" type="password" placeholder="Palavra-passe" name="password" minlength="8" maxlength="20" required> </td>
                </tr>
                <tr>
                    <td> <input class="inputs" type="password" placeholder="Confirmar palavra-passe" name="confirm_password" minlength="8" maxlength="20" required> </td>
                </tr>
                <tr>
                    <td> <button class="submit" type="submit" name="submit">Confirmar</button> </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>