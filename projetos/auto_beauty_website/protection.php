<?php

if (!function_exists("protection")) {                                           // Se não existir a função protection...
    function protection() {                                                     // Então será criada essa função.
        if(!isset($_SESSION)) {                                                 // Se não existir uma sessão...
            session_start();                                                    // Então será criada uma sessão.
        }
        if((!isset($_SESSION['email'])) && (!isset($_SESSION['password']))) {   // Verificar se existe um utilizador...
            header("location:../login_form.php");                               // Caso nao exista ele volta para a página de login.
        }
    }
}