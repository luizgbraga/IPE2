<?php

// inicialize a sessão
session_start();
 
require_once("app/app.php");

 
// Defina variáveis e inicialize com valores vazios
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if(is_post()){

    if(empty(trim($_POST["username"]))) {
        $username_err = "Por favor, insira o nome de usuário.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Verifique se a senha está vazia
    if(empty(trim($_POST["password"]))) {
        $password_err = "Por favor, insira sua senha.";
    } else {
        $password = trim($_POST["password"]);
    }
 
    // Verifique se o nome de usuário está vazio
    if(empty($username_err) && empty($password_err)) {
        if(Data::auth_user($username, $password) > 0) {
            session_start();

            $_SESSION['remember'] = $_POST['remember'];          
            $_SESSION["loggedin"] = true;
            $_SESSION["password"] = $password;
            $_SESSION["username"] = $username;    
            $_SESSION["id"] = Data::get_id($_SESSION["username"], $_SESSION["password"]);       
            $_SESSION["nome"] = Data::get_name($_SESSION["id"])[0];          
            $_SESSION["sigla"] = Data::get_name($_SESSION["id"])[1];       
            
            header("location: welcome.php");
        } else {
            $login_err = "Nome de usuário ou senha inválidos.";
        }
    }
}

include('./views/login.view.php');

?>
