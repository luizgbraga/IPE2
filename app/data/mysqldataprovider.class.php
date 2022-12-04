<?php

require('classes/dados.class.php');
require('classes/input.class.php');
require('classes/mensagem.class.php');
require('classes/om.class.php');

class MySqlDataProvider extends DataProvider {

    // retorna todos os usuários em uma array de objetos da classe OM
    public function get_users() {
        $result = $this->query('SELECT * FROM users');

        $oms = [];

        foreach($result as $row) {
            $om = new OM();
            $om->id = $row['id'];
            $om->nome = $row['nome'];
            $om->sigla = $row['sigla'];
            $oms = [...$oms, $om];
        }

        return $oms;
    }

    // retorna o usuário provido de certo id, em um objeto da classe OM
    public function get_user($id) {
        $result = $this->query(
            'SELECT * FROM users WHERE id = :id',
            [':id' => $id]
        );

        $oms = [];

        foreach($result as $row) {
            $om = new OM();
            $om->id = $row['id'];
            $om->nome = $row['nome'];
            $om->sigla = $row['sigla'];
            $oms = [...$oms, $om];
        }

        return $oms[0];
    }

    // atualiza um usuário com dados secundários
    public function update_secundary($id, $efetivo, $metragem, $possui_subordinados, $possui_gerdistr) {
        $this->execute(
            'UPDATE users SET 
            efetivo = :efetivo, 
            metragem = :metragem, 
            possui_subordinados = :possui_subordinados, 
            possui_gerdistr = :possui_gerdistr 
            WHERE id = :id',

            [
                ':id' => $id,
                ':efetivo' => $efetivo,
                ':metragem' => $metragem,
                ':possui_subordinados' => $possui_subordinados,
                ':possui_gerdistr' => $possui_gerdistr
            ]
        );
    }

    // atualiza um usuário com dados energéticos
    public function update_energetic($id, $concessionaria, $grupo, $subgrupo, $modalidade, $demanda_up, $demanda_ufp, $demanda_sp, $demanda_sfp) {
        $this->execute(
            'UPDATE users SET 
            concessionaria = :concessionaria, 
            grupo = :grupo, 
            subgrupo = :subgrupo, 
            modalidade = :modalidade,
            demanda_up = :demanda_up,
            demanda_ufp = :demanda_ufp,
            demanda_sp = :demanda_sp,
            demanda_sfp = :demanda_sfp
            WHERE id = :id',
    
            [
                ':id' => $id,
                ':concessionaria' => $concessionaria,
                ':grupo' => $grupo,
                ':subgrupo' => $subgrupo,
                ':modalidade' => $modalidade,
                ':demanda_up' => $demanda_up,
                ':demanda_ufp' => $demanda_ufp,
                ':demanda_sp' => $demanda_sp,
                ':demanda_sfp' => $demanda_sfp,
            ]
        );
    }

    // retorna uma array com as informações secundárias de um certo id
    public function get_secundary($id) {
        $result = $this->query(
            'SELECT * FROM users WHERE id = :id',
            [':id' => $id]
        );

        foreach($result as $row) {
            $secundary_infos = array( 
                'efetivo' => $row['efetivo'],
                'metragem' => $row['metragem'],
                'possui_subordinados' => $row['possui_subordinados'],
                'possui_gerdistr' => $row['possui_gerdistr']
            );
        }

        return $secundary_infos;
    }

    // retorna uma array com as informações energéticas de um certo id
    public function get_energetic($id) {
        $result = $this->query(
            'SELECT * FROM users WHERE id = :id',
            [':id' => $id]
        );
    
        foreach($result as $row) {
            $energetic_infos = array( 
                'concessionaria' => $row['concessionaria'],
                'grupo' => $row['grupo'],
                'subgrupo' => $row['subgrupo'],
                'modalidade' => $row['modalidade'],
                'demanda_up' => $row['demanda_up'],
                'demanda_ufp' => $row['demanda_ufp'],
                'demanda_sp' => $row['demanda_sp'],
                'demanda_sfp' => $row['demanda_sfp']
            );
        }
    
        return $energetic_infos;
    }

    // retorna o nome e sigla de uma om provida de certo id
    public function get_name($id) {
        $result = $this->query(
            'SELECT * FROM users WHERE id = :id',
            [':id' => $id]
        );

        foreach($result as $row) {
            $om = array( 
                'nome' => $row['nome'],
                'sigla' => $row['sigla'],
            );
        }

        return $om;
    }

    // retorna uma array com os inputs de um determinado id
    public function get_inputs($id) {
        $result = $this->query(
            'SELECT * FROM users WHERE id = :id',
            [':id' => $id]
        );

        $inputs = '';

        foreach($result as $row) {
            $inputs = $row['inputs'];
        }

        return json_decode($inputs);
    }

    // retorna uma array com as mensagens de um determinado id
    public function get_mensagens($id) {
        $result = $this->query(
            'SELECT * FROM users WHERE id = :id',
            [':id' => $id]
        );

        foreach($result as $row) {
            $mensagens = $row['mensagens'];
        }

        return json_decode($mensagens);
    }

    // retorna uma array com os subordinados de um determinado id
    public function get_subordinados($id) {
        $result = $this->query(
            'SELECT * FROM users WHERE id = :id',
            [':id' => $id]
        );

        foreach($result as $row) {
            $subordinados = $row['subordinados'];
        }

        return json_decode($subordinados);
    }
    
    // adiciona um usuário no banco de dados
    public function add_user($login, $senha, $nome, $sigla) {
        $sql = "INSERT INTO users SET 
        login = :login, 
        senha = :senha,
        nome = :nome, 
        sigla = :sigla, 
        possui_subordinados = 0,
        concessionaria = '',
        grupo = '',
        subgrupo = '',
        modalidade = '',
        efetivo = 0,
        metragem = 0,
        possui_gerdistr = 0,
        demanda_up = 0,
        demanda_ufp = 0,
        demanda_sp = 0,
        demanda_sfp = 0,
        subordinados = '{}',
        inputs = '{}',
        mensagens = '{}',
        master = 0
        ";

        $this->execute(
            $sql,
            [
                ':login' => $login,
                ':senha' => $senha,
                ':nome' => $nome,
                ':sigla' => $sigla,
            ]
        );
    }

    // adiciona um dado de input à OM com certo id
    function add_input($id, $data, $consumo_p, $consumo_fp, $demanda_medida_p, $demanda_medida_fp, $energia_reativa, $energia_ativa, $ger_distribuida) {
        $dados = new Dados();
        $dados->consumo_p = $consumo_p;
        $dados->consumo_fp = $consumo_fp;
        $dados->demanda_medida_p = $demanda_medida_p;
        $dados->demanda_medida_fp = $demanda_medida_fp;
        $dados->energia_reativa = $energia_reativa;
        $dados->energia_ativa = $energia_ativa;
        $dados->ger_distribuida = $ger_distribuida;
        
        $input = new Input();
        $input->id = $id;
        $input->data = $data;
        $input->dados = $dados;

        $input_arr = (array) $input;
        $old_inputs = (array) $this->get_inputs($id);
        $updated_inputs = (object) [...$old_inputs, $input_arr];
        $inputJSON = json_encode($updated_inputs);

        $this->execute(
            'UPDATE users SET inputs = :input WHERE id = :id',
            [
                ':id' => $id,
                ':input' => $inputJSON
            ]
        );
    }

    // atualiza um input de certa key com a OM de certo id
    public function update_input($id, $key, $data, $consumo_p, $consumo_fp, $demanda_medida_p, $demanda_medida_fp, $energia_reativa, $energia_ativa, $ger_distribuida) {
        $dados = new Dados();
        $dados->consumo_p = $consumo_p;
        $dados->consumo_fp = $consumo_fp;
        $dados->demanda_medida_p = $demanda_medida_p;
        $dados->demanda_medida_fp = $demanda_medida_fp;
        $dados->energia_reativa = $energia_reativa;
        $dados->energia_ativa = $energia_ativa;
        $dados->ger_distribuida = $ger_distribuida;

        $input = new Input();
        $input->id = $id;
        $input->data = $data;
        $input->dados = $dados;

        $old_inputs = (array) $this->get_inputs($id);
        $old_inputs[$key] = $input;
        $inputJSON = json_encode($old_inputs);

        $this->execute(
            'UPDATE users SET inputs = :input WHERE id = :id',
            [
                ':id' => $id,
                ':input' => $inputJSON
            ]
        );
    }

    // retorna a quantidade de usuários com um determinado $login e $senha
    public function auth_user($login, $senha) {
        $db = $this->connect();

        if($db === null) {
            return;
        }

        $sql = 'SELECT * FROM users WHERE login = :login AND senha = :senha';
        $smt = $db->prepare($sql);

        $smt->execute([
            ':login' => $login,
            ':senha' => $senha
        ]);

        $count = $smt->rowCount();

        $smt = null;
        $db = null;

        return $count;
    }

    // retorna uma array com objetos da classe OM que correspondem à pesquisa
    public function search_user($search) {
        $result = $this->query(
            'SELECT * FROM users WHERE nome LIKE :search OR sigla LIKE :search',
            [':search' => '%' . $search . '%']
        );

        $oms = [];

        foreach($result as $row) {
            $om = new OM();
            $om->nome = $row['nome'];
            $om->sigla = $row['sigla'];
            $oms = [...$oms, $om];
        }

        return $oms;
    }

    // retorna o id do usuário com certo login e senha
    public function get_id($login, $senha) {
        $result = $this->query(
            'SELECT * FROM users WHERE login = :login AND senha = :senha',
            [
                ':login' => $login,
                ':senha' => $senha
            ]
        );

        $id = 0;

        foreach($result as $row) {
            $id = $row['id'];
        }

        return $id;
    }

    // envia uma mensagem (objeto da classe mensagem) de um $from para um $id
    public function send_notification($id, $from) {
        $mensagem = new Mensagem();
        $mensagem->from = $this->get_user($from);

        $mensagem_arr = (array) $mensagem;
        $old_mensagens = (array) $this->get_mensagens($id);
        $updated_mensagens = (object) [...$old_mensagens, $mensagem_arr];
        $mensagensJSON = json_encode($updated_mensagens);

        $this->execute(
            'UPDATE users SET mensagens = :mensagem WHERE id = :id',
            [
                ':id' => $id,
                ':mensagem' => $mensagensJSON
            ]
        );
    }

    // atuliza os subordinados de $id, adicionando $from
    public function update_subordinados($from, $id) {
        $old_subordinados = (array) $this->get_subordinados($id);
        $new_subordinado = $this->get_user($from);
        $updated_subordinados = (object) [...$old_subordinados, $new_subordinado];
        $subordinadosJSON = json_encode($updated_subordinados);

        $this->execute(
            'UPDATE users SET subordinados = :subordinado WHERE id = :id',
            [
                ':id' => $id,
                ':subordinado' => $subordinadosJSON
            ]
        );
    }

    // aceita a mensagem
    public function accept_notification($id, $from) {
        $old_mensagens = (array) $this->get_mensagens($id);
        $updated_mensagens = [];

        foreach($old_mensagens as $mensagem) {
            if($mensagem->from->id != $from) {
                $updated_mensagens = [...$updated_mensagens, $mensagem];
            }
        }

        $updated_mensagens = (object) $updated_mensagens;
        $mensagensJSON = json_encode($updated_mensagens);

        $this->execute(
            'UPDATE users SET mensagens = :mensagem WHERE id = :id',
            [
                ':id' => $id,
                ':mensagem' => $mensagensJSON
            ]
        );

        $this->update_subordinados($id, $from);
    }

    // executa um SQL que não retorna nada, só altera a base de dados
    private function execute($sql, $sql_params) {
        $db = $this->connect();

        if($db === null) {
            return;
        }

        $smt = $db->prepare($sql);
        $smt->execute($sql_params);

        $smt = null;
        $db = null;
    }
    
    // executa um SQL retornando algo
    private function query($sql, $sql_params = []) {
        $db = $this->connect();

        if($db === null) {
            return;
        }

        $smt = null;

        if(empty($sql_params)) {
            $smt = $db->query($sql);
        } else {
            $smt = $db->prepare($sql);
            $smt->execute($sql_params);
        }

        $data = $smt->fetchAll(PDO::FETCH_ASSOC);

        $smt = null;
        $db = null;

        return $data;
    }
    
    // conecta com a base de dados
    private function connect() {
        try {
            return new PDO("mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_93cd3b7bf584ab1", CONFIG['db_user'], CONFIG['db_password']);
        } catch(PDOException $e) {
            echo 'not';
            return null;
        }
    }
}

?>