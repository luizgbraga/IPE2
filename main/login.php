<?php

// inicialize a sessão
session_start();
 
require_once("../app/app.php");

$username = $password = '';
$username_err = $password_err = $login_err = '';
 
if(is_post()) {

    if(empty(trim($_POST['username']))) {
        $username_err = 'Insira o nome de usuário';
    } else {
        $username = trim($_POST['username']);
    }
    
    if(empty(trim($_POST['password']))) {
        $password_err = 'Insira sua senha';
    } else {
        $password = trim($_POST['password']);
    }
 
    if(empty($username_err) && empty($password_err)) {
        if(Data::auth_user($username, $password) > 0) {
            session_start();

            $_SESSION['remember-me'] = $_POST['remember-me'];          
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password; 
            $_SESSION['id'] = Data::get_id($_SESSION['username'], $_SESSION['password']);       
            $_SESSION['nome'] = Data::get_name($_SESSION['id'])['nome'];         
            $_SESSION['sigla'] = Data::get_name($_SESSION['id'])['sigla']; 
            $_SESSION['master'] = Data::get_master($_SESSION['id']); 
            if($_SESSION['master'] === 0) {
                $associate_id = Data::get_id_sigla($_SESSION['sigla']);
                $_SESSION['associate-id'] = $associate_id;
                $sec_inputs = Data::get_secundary($associate_id);
                $en_inputs = Data::get_energetic($associate_id);
                Data::update_secundary($_SESSION['id'], $sec_inputs['efetivo'], $sec_inputs['metragem'], $sec_inputs['possui_subordinados'], $sec_inputs['possui_gerdistr']);
                Data::update_energetic($_SESSION['id'], $en_inputs['concessionaria'], $en_inputs['grupo'], $en_inputs['subgrupo'], 
                $en_inputs['modalidade'], $en_inputs['demanda_up'], $en_inputs['demanda_ufp'], $en_inputs['demanda_sp'], $en_inputs['demanda_sfp']);
            }   
            redirect('welcome.php');
        } else {
            $login_err = 'Nome de usuário ou senha inválidos';
        }
    }
}

include('../views/login.view.php');

?>
