<?php

require('dataprovider.class.php');

class Data {
    
    static private $ds;

    static public function initialize(DataProvider $data_provider) {
        return self::$ds = $data_provider;
    }

    static public function get_users() {
        return self::$ds->get_users();
    }

    static public function get_user($id) {
        return self::$ds->get_user($id);
    }

    static public function get_master($id) {
        return self::$ds->get_master($id);
    }

    static public function get_id_sigla($sigla) {
        return self::$ds->get_id_sigla($sigla);
    }

    static public function update_secundary($id, $efetivo, $metragem, $possui_subordinados, $possui_gerdistr) {
        return self::$ds->update_secundary($id, $efetivo, $metragem, $possui_subordinados, $possui_gerdistr);
    }

    static public function update_energetic($id, $concessionaria, $grupo, $subgrupo, $modalidade, $demanda_up, $demanda_ufp, $demanda_sp, $demanda_sfp) {
        return self::$ds->update_energetic($id, $concessionaria, $grupo, $subgrupo, $modalidade, $demanda_up, $demanda_ufp, $demanda_sp, $demanda_sfp);
    }

    static public function get_secundary($id) {
        return self::$ds->get_secundary($id);
    }

    static public function get_energetic($id) {
        return self::$ds->get_energetic($id);
    }
    
    static public function get_name($id) {
        return self::$ds->get_name($id);
    }

    static public function get_inputs($id) {
        return self::$ds->get_inputs($id);
    }

    static public function get_mensagens($id) {
        return self::$ds->get_mensagens($id);
    }

    static public function get_subordinados($id) {
        return self::$ds->get_subordinados($id);
    }

    static public function add_user($login, $senha, $nome, $sigla) {
        return self::$ds->add_user($login, $senha, $nome, $sigla);
    }

    static public function add_input($id, $data, $consumo_p, $consumo_fp, $demanda_medida_p, $demanda_medida_fp, $energia_reativa, $energia_ativa, $ger_distribuida) {
        return self::$ds->add_input($id, $data, $consumo_p, $consumo_fp, $demanda_medida_p, $demanda_medida_fp, $energia_reativa, $energia_ativa, $ger_distribuida);
    }

    static public function update_input($id, $key, $data, $consumo_p, $consumo_fp, $demanda_medida_p, $demanda_medida_fp, $energia_reativa, $energia_ativa, $ger_distribuida) {
        return self::$ds->update_input($id, $key, $data, $consumo_p, $consumo_fp, $demanda_medida_p, $demanda_medida_fp, $energia_reativa, $energia_ativa, $ger_distribuida);
    }

    static public function auth_user($login, $senha) {
        return self::$ds->auth_user($login, $senha);
    }

    static public function search_user($search) {
        return self::$ds->search_user($search);
    }

    static public function get_id($login, $senha) {
        return self::$ds->get_id($login, $senha);
    }

    static public function update_subordinados($id, $from) {
        return self::$ds->update_subordinados($id, $from);
    }

    static public function send_notification($id, $from) {
        return self::$ds->send_notification($id, $from);
    }

    static public function accept_notification($id, $from) {
        return self::$ds->accept_notification($id, $from);
    }
}

?>