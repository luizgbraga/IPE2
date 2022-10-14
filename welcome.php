<?php

// inicialize a sessão

session_start();

require_once("app/app.php");
 
// verifique se está logado; senão, redirecione para o login
// ensure_user_is_authenticated();

class Consumo {
    public $data;
    public $consumo;
}

include('./views/welcome.view.php');

?>
