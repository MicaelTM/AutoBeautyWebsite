<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/verify_registration_alerts.css">
</head>
<body>
    <?php
    
    require 'db_connection.php';
    session_start();
    
    $submit = filter_input(INPUT_POST, 'submit');
    
    if (isset($submit)) {
        /////// Guardar campos passados pelo formulário de registo /////////////////////////////////////////////////////////////////////////////////

        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $confirm_password = filter_input(INPUT_POST, 'confirm_password');
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {       // If para verificar se o email do utilizador é válido.
            echo '<div class="custom_alert">'
                    .'<div class="centering">'
                        .'<text>Insira um endereço de email válido!</text><br>'
                        .'<a href="registration_form.php">'
                            .'<button>Voltar</button>'
                        .'</a>'
                    .'</div>'
                .'</div>';
        } else {
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            
            if(!$uppercase || !$lowercase || !$number) {        // If para verificar se a password do utilizador é válida com os requerimentos pedidos.
                echo '<div class="custom_alert">'
                        .'<div class="centering">'
                            .'<text>Insira uma palavra-passe válida! Esta deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.</text><br>'
                            .'<a href="registration_form.php">'
                                .'<button>Voltar</button>'
                            .'</a>'
                        .'</div>'
                    .'</div>';
            } else {
                /////// Criar tabela users na bd se esta ainda não existir /////////////////////////////////////////////////////////////////////////

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

                /////// Selecionar email do utilizador /////////////////////////////////////////////////////////////////////////////////////////////

                $fetch_email = "SELECT email FROM users";
                $email_result = $pdo -> query($fetch_email);

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $count = 0;                                                 // Inicializar um contador.
                foreach ($email_result -> fetchAll() as $row) {
                    $email_text = $row['email'];
                    if($email_text == $email) {                             // Se sim, então já existe um utilizador com aquele email, vou adiciona-lo ao contador.
                        $count++;
                    }
                }

                if($count > 0) {                                            // Se o contador é maior que 0 então é porque o email do utilizador já existe.
                    echo '<div class="custom_alert">'
                            .'<div class="centering">'
                                .'<text>O email inserido já se encontra registado!</text><br>'
                                .'<a href="registration_form.php">'
                                    .'<button>Voltar</button>'
                                .'</a>'
                            .'</div>'
                        .'</div>';
                } else {                                                    // Senão vai ser criado um novo utilizador na base de dados.
                    if ($password != $confirm_password) {
                        echo '<div class="custom_alert">'
                                .'<div class="centering">'
                                    .'<text>As palavras-passe não coincidem!</text><br>'
                                    .'<a href="registration_form.php">'
                                        .'<button>Voltar</button>'
                                    .'</a>'
                                .'</div>'
                            .'</div>';
                    } else {
                        $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);      // Encriptar a password confirmada para depois inserir na base de dados.
                        $hash_value = md5(rand(0,1000));                                            // Valor hash aleatório para o link de verificação de email ser mais seguro.

                        $new_user = "INSERT INTO users (first_name, last_name, email, password, is_admin, hash_value, user_activation_status) VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '0', '$hash_value', '0')";
                        $user_result = $pdo -> query($new_user);

                        /////// Email a ser despultado no registo //////////////////////////////////////////////////////////////////////////////////////////
                        /////// Para este código funcionar têm de ser modificados 2 ficheiros no XAMPP (abrir imagem ou abrir txt "email-mudar_no_xampp" ///

                        if (isset($user_result)) {
                            $to = $email;
                            $subject = 'Registo Auto Beauty | Verificação';
                            $message = 'Obrigado por se registar no nosso website.<br>'
                                        .'A sua conta com o email '.$email.' foi criada com sucesso.<br><br>'
                                        .'Clique no link abaixo para ativar a sua conta:<br>'
                                        .'http://localhost/projetos/auto_beauty_website/verify_email.php?email='.$email.'&hash_value='.$hash_value.'';
                            $headers[] = 'MIME-Version: 1.0';
                            $headers[] = 'Content-type: text/html; charset=utf-8';

                            if (mail($to, $subject, $message, implode("\r\n", $headers))) {
                                echo '<div class="custom_alert">'
                                        .'<div class="centering">'
                                            .'<text>Foi enviado um email de verificação para '.$to.'</text><br>'
                                            .'<a href="login_form.php">'
                                                .'<button>Iniciar sessão</button>'
                                            .'</a>'
                                        .'</div>'
                                    .'</div>';
                            } else {
                                echo '<div class="custom_alert">'
                                        .'<div class="centering">'
                                            .'<text>Ocorreu um erro, tente mais tarde.</text><br>'
                                            .'<a href="registration_form.php">'
                                                .'<button>Voltar</button>'
                                            .'</a>'
                                        .'</div>'
                                    .'</div>';
                            }
                        }
                    }
                }
            }
        }
    }
    
    ?>
</body>
</html>