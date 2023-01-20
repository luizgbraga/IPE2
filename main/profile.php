<?php

// inicialize a sessão
session_start();

require_once("../app/app.php");
 
// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();

$sec = Data::get_secundary(($_SESSION['id']));
$en = Data::get_energetic($_SESSION['id']);
 
$efetivo = $metragem = 0;
$concessionaria = $grupo = $subgrupo = $modalidade = '';
$demanda_sp = $demanda_up = 0;
$possui_subordinados = $possui_gerdistr = 0;

if(is_post()) {

    if($_POST['form-name'] === 'secundary') {

        if(!empty(trim($_POST['efetivo']))) {
            $efetivo = trim($_POST['efetivo']);
         }
     
         if(!empty(trim($_POST['metragem']))) {
             $metragem = trim($_POST['metragem']);
         }
         
         Data::update_secundary($_SESSION['id'], $efetivo, $metragem, $sec['possui_subordinados'], $sec['possui_gerdistr']);

    } else if($_POST['form-name'] === 'energetic') {

        if(!empty(trim($_POST['concessionaria']))) {
            $concessionaria = trim($_POST['concessionaria']);
         }
     
         if(!empty(trim($_POST['grupo']))) {
             $grupo = trim($_POST['grupo']);
         }

         if(!empty(trim($_POST['subgrupo']))) {
            $subgrupo = trim($_POST['subgrupo']);
        }

        if(!empty(trim($_POST['modalidade']))) {
            $modalidade = trim($_POST['modalidade']);
        }

        if(!empty(trim($_POST['demanda_sp']))) {
            $demanda_sp = trim($_POST['demanda_sp']);
        }

        if(!empty(trim($_POST['demanda_up']))) {
            $demanda_up = trim($_POST['demanda_up']);
        }

        if($modalidade == 'azul') {
            if(!empty(trim($_POST['demanda_sp_azul']))) {
                $demanda_sp = trim($_POST['demanda_sp_azul']);
            }
    
            if(!empty(trim($_POST['demanda_up']))) {
                $demanda_up = trim($_POST['demanda_up']);
            }

            if(!empty(trim($_POST['demanda_sfp']))) {
                $demanda_sfp = trim($_POST['demanda_sfp']);
            }
    
            if(!empty(trim($_POST['demanda_up']))) {
                $demanda_ufp = trim($_POST['demanda_ufp']);
            }
        }

        if(isset($_POST['possui_subordinados'])) {
            $possui_subordinados = detranslator(trim($_POST['possui_subordinados']));
        }

        if(isset($_POST['possui_gerdistr'])) {
            $possui_gerdistr = detranslator(trim($_POST['possui_gerdistr']));
        }

        if($modalidade == 'azul') {
            Data::update_energetic($_SESSION['id'], $concessionaria, $grupo, $subgrupo, $modalidade, $demanda_up, $demanda_ufp, $demanda_sp, $demanda_sfp);
        } else {
            Data::update_energetic($_SESSION['id'], $concessionaria, $grupo, $subgrupo, $modalidade, $demanda_up, $demanda_up, $demanda_sp, $demanda_sp);
        }
        Data::update_secundary($_SESSION['id'], $sec['efetivo'], $sec['metragem'], $possui_subordinados, $possui_gerdistr);
        redirect('profile.php');

    }

}

$profile_warnings = array_map('value', $sec);
$energetic_warnings = array_map('value', $en);

include('../views/profile.view.php');

?>
