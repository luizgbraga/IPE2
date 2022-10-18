<?php

// inicialize a sessão
session_start();

require_once("app/app.php");

// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();

$search = '';
$users = Data::get_users();

if(isset($_GET['search'])) {
    $users = Data::search_user($_GET['search']);
}  else {
    $users = Data::get_users();
}

if(isset($_GET['id'])) {
    Data::send_notification($_GET['id'], $_GET['from']);
    redirect('acesslevel.php');
}

include('./views/acesslevel.view.php');

?>