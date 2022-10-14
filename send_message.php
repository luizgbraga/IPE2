<?php

// inicialize a sessão
session_start();
 
require_once("app/app.php");

// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();
 
Data::send_notification($_GET['id'], $_GET['from']);

include('./views/send_message.view.php');

?>