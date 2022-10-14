<?php

function redirect($url) {
    header("Location: $url");
    die();
}

function is_post() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function is_get() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function is_user_authenticated() {
    return isset($_SESSION['loggedin']);
}

function ensure_user_is_authenticated() {
    if (!is_user_authenticated()) {
      redirect('/ipeV1/login.php');
    }
}

function value($el) {
    if(empty($el)) {
        return 'Não há';
    } else {
        return $el;
    }
}

?>