<?php

// inicialize a sessão
session_start();

require_once("app/app.php");
 
// remova todas as variáveis de sessão
$_SESSION = array();
 
// destrua a sessão.
session_destroy();
 
// redirecionar para a página de login
redirect('login.php');

exit;

?>