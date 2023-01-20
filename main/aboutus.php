<?php

// inicialize a sesssão
session_start();
 
require_once("../app/app.php");

// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();

include('../views/aboutus.view.php');

?>