<?php

session_start();                    // Iniciar a sessão.
unset($_SESSION['email']);          // Destruir a variável email da sessão atual.
unset($_SESSION['password']);       // Destruir a variável password da sessão atual.
session_destroy();                  // Destruir a sessão.
header ('location:login_form.php'); // Volta/vai para a página de login.