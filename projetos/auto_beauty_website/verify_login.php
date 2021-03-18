<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/verify_login_alerts.css">
</head>
<body>
    <?php
    
    require 'db_connection.php';

    /////// Criar sessões //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    session_start ();
    $form_email = filter_input(INPUT_POST, 'email');
    $form_password = filter_input(INPUT_POST, 'password');
    
    /////// Criar tabela users na bd se esta ainda não existir /////////////////////////////////////////////////////////////////////////////////////
    
    $users_table = "CREATE TABLE IF NOT EXISTS users (
        first_name VARCHAR(10) NOT NULL,
        last_name VARCHAR(15) NOT NULL,
        email VARCHAR(45) PRIMARY KEY NOT NULL,
        password VARCHAR(100) NOT NULL,
        is_admin BOOLEAN NOT NULL,
        hash_value VARCHAR(32) NOT NULL,
        user_activation_status BOOLEAN NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $pdo -> query($users_table);
    
    /////// Procurar o email do utilizador na bd ///////////////////////////////////////////////////////////////////////////////////////////////////

    $fetch_email = "SELECT * FROM users WHERE email = '".$form_email."'";
    $email_result = $pdo -> query($fetch_email);
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $records_number = $email_result -> rowcount();                                              // Guarda o numero de registos.

    if ($records_number != 0) {                                                                 // Verificar se existe registo.
        foreach ($email_result -> fetchAll() as $row) {                                         // Os resultados serao guardados numa variavel $row.
            if (password_verify($form_password, $row['password']) && $row['password'] != '') {  // Comparar a password inserida no formulário com a encriptada da bd e verificar se é da bd é diferente de vazio.
                $_SESSION['email'] = $row['email'];                                             // As sessoes servem para depois buscar os nomes para outras paginas por exemplo.
                $_SESSION['first_name'] = $row['first_name'];
                
                $user_activation_status = $row['user_activation_status'];
                
                if ($user_activation_status == 1) {                                             // Se o status do utilizador for 1 é porque o email foi verificado.
                    if ($row['is_admin'] == 1) {                                                // Verificar se é admin.
                        $_SESSION ['is_admin'] = $row['is_admin'];
                        header ('location: admin/admin_homepage.php');                          // Se sim, vai para a homepage de administração.
                    } else {
                        header ('location: client/client_homepage.php?username='.$form_email);  // Senão vai para a homepage do cliente.
                    }
                } else {
                    echo '<div class="custom_alert">'
                            .'<div class="centering">'
                                .'<text>Email não verificado! Clique no link de verificação enviado para o seu email.</text><br>'
                                .'<a href="login_form.php">'
                                    .'<button>Voltar</button>'
                                .'</a>'
                            .'</div>'
                        .'</div>';
                }
            } else {
                echo '<div class="custom_alert">'
                        .'<div class="centering">'
                            .'<text>Email ou palavra-passe incorretos!</text><br>'
                            .'<a href="login_form.php">'
                                .'<button>Voltar</button>'
                            .'</a>'
                        .'</div>'
                    .'</div>';
            }
        }
    } else {
        echo '<div class="custom_alert">'
                .'<div class="centering">'
                    .'<text>Email ou palavra-passe incorretos!</text><br>'
                    .'<a href="login_form.php">'
                        .'<button>Voltar</button>'
                    .'</a>'
                .'</div>'
            .'</div>';
    }
    
    ?>
</body>
</html>