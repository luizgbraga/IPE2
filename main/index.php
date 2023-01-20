<?php

// inicialize a sessão
session_start();

require_once("../app/app.php");
 
// verifique se está logado; senão, redirecione para o login; se sim, ao welcome
ensure_user_is_authenticated();

?>