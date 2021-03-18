<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/verify_email.css">
</head>
<body>
    <?php
    
    require 'db_connection.php';

    $email = filter_input(INPUT_GET, 'email');
    $hash_value = filter_input(INPUT_GET, 'hash_value');

    $search = "SELECT email, hash_value, user_activation_status FROM users WHERE email = '".$email."' AND hash_value = '".$hash_value."' AND user_activation_status = '0'";
    $match = $pdo -> query($search);

    $count = $match->rowCount();

    if ($count > 0) {
        $update_status = "UPDATE users SET user_activation_status = '1' WHERE email = '".$email."' AND hash_value = '".$hash_value."' AND user_activation_status = '0'";
        $result = $pdo -> query($update_status);
        echo '<div class="custom_alert">'
                .'<div class="centering">'
                    .'<text>Email verificado com sucesso!</text><br>'
                    .'<a href="login_form.php">'
                        .'<button>Iniciar sessão</button>'
                    .'</a>'
                .'</div>'
            .'</div>';
    } else {
        echo '<div class="custom_alert">'
                .'<div class="centering">'
                    .'<text>Ocorreu um erro, tente mais tarde.</text><br>'
                    .'<a href="login_form.php">'
                        .'<button>Iniciar sessão</button>'
                    .'</a>'
                .'</div>'
            .'</div>';
    }
    
    ?>
</body>
</html>