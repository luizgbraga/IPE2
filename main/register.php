<?php

require_once("../app/app.php");
 
$nome = $sigla = $login = $senha = $confirm_senha = '';
$nome_err = $sigla_err = $login_err = $senha_err = $confirm_senha_err = '';
 
if(is_post()) {
 
    if(empty(trim($_POST['nome']))) {
        $nome_err = 'Insira o nome de sua OM';
    } else {
        $nome = trim($_POST['nome']);
    }
    
    if(empty(trim($_POST['sigla']))) {
        $sigla_err = 'Insira a sigla de sua OM';     
    } else {
        $sigla = trim($_POST['sigla']);
    }

    if(empty(trim($_POST['login']))) {
        $login_err = 'Insira um login para sua OM';     
    } else {
        $login = trim($_POST['login']);
    }

    if(empty(trim($_POST['senha']))) {
        $senha_err = 'Insira uma senha para sua OM';     
    } else {
        $senha = trim($_POST['senha']);
    }
    
    if(empty(trim($_POST['confirm_senha']))) {
        $confirm_senha_err = 'Confirme a senha';     
    } else {
        $confirm_senha = trim($_POST['confirm_senha']);
        if(empty($senha_err) && ($senha != $confirm_senha)) {
            $confirm_senha_err = 'A senha não confere';
        }
    }

    if(empty($nome_err) && empty($sigla_err) && empty($login_err) && empty($senha_err) && empty($confirm_senha_err)) {
        Data::add_user($login, $senha, $nome, $sigla);
        redirect('login.php');
    }
}

include('../views/register.view.php');

?>
 
