<?php

// inicialize a sessão
session_start();
 
require_once('app/app.php');

$username = $password = '';
$username_err = $password_err = $login_err = '';
 
if(is_post()){

    // verificar se o nome do usuário está vazio
    if(empty(trim($_POST['username']))) {
        $username_err = 'Insira o nome de usuário';
    } else {
        $username = trim($_POST['username']);
    }
    
    // verificar se a senha está vazia
    if(empty(trim($_POST['password']))) {
        $password_err = 'Insira sua senha';
    } else {
        $password = trim($_POST['password']);
    }
 
    // verificar se não há erros nos inputs
    if(empty($username_err) && empty($password_err)) {
        if(Data::auth_user($username, $password) > 0) {
            session_start();

            $_SESSION['remember-me'] = $_POST['remember-me'];          
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password; 
            $_SESSION['id'] = Data::get_id($_SESSION['username'], $_SESSION['password']);       
            $_SESSION['nome'] = Data::get_name($_SESSION['id'])[0];          
            $_SESSION['sigla'] = Data::get_name($_SESSION['id'])[1];       
            
            header('location: welcome.php');
        } else {
            $login_err = 'Nome de usuário ou senha inválidos';
        }
    }
}

include('./views/login.view.php');

?>
