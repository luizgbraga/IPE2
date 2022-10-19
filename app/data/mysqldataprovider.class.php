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

        return $oms;
    }

    // atualiza um usuário com dados secundários (efetivo, metragem, demanda, modalidade)
    public function update_user($id, $efetivo, $metragem, $demanda, $modalidade) {
        $this->execute(
            'UPDATE users SET 
            efetivo = :efetivo, 
            metragem = :metragem, 
            demanda = :demanda, 
            modalidade = :modalidade 
            WHERE id = :id',

            [
                ':id' => $id,
                ':efetivo' => $efetivo,
                ':metragem' => $metragem,
                ':demanda' => $demanda,
                ':modalidade' => $modalidade
            ]
        );
    }

    // retorna uma array com as informações secundárias de um certo id
    public function get_secundary($id) {
        $result = $this->query(
            'SELECT * FROM users WHERE id = :id',
            [':id' => $id]
        );

        $infos = [];

        foreach($result as $row) {
            $infos = [$row['efetivo'], $row['metragem'], $row['demanda'], $row['modalidade']];
        }

        return $infos;
    }

    // retorna o nome e sigla de uma om provida de certo id
    public function get_name($id) {
        $result = $this->query(
            'SELECT * FROM users WHERE id = :id',
            [':id' => $id]
        );

        foreach($result as $row) {
            $om = [];
            $om = [...$om, $row['nome']];
            $om = [...$om, $row['sigla']];
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
    public function add_user($nome, $sigla, $login, $senha) {
        $sql = "INSERT INTO users SET 
        nome = :nome, 
        sigla = :sigla, 
        login = :login, 
        senha = :senha,
        efetivo = 0,
        metragem = 0,
        demanda = 0,
        modalidade = '',
        subordinados = '{}',
        inputs = '{}',
        mensagens = '{}'";

        $this->execute(
            $sql,
            [
                ':nome' => $nome,
                ':sigla' => $sigla,
                ':login' => $login,
                ':senha' => $senha
            ]
        );
    }

    // adiciona um dado de input à OM com certo id
    function add_input($id, $data, $consumo, $demanda_medida, $energia_reativa, $energia_ativa) {
        $dados = new Dados();
        $dados->consumo = $consumo;
        $dados->demanda_medida = $demanda_medida;
        $dados->energia_reativa = $energia_reativa;
        $dados->energia_ativa = $energia_ativa;
        
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
    public function add_input($id, $key, $data, $consumo, $demanda_medida, $energia_reativa, $energia_ativa) {
        $dados = new Dados();
        $dados->consumo = $consumo;
        $dados->demanda_medida = $demanda_medida;
        $dados->energia_reativa = $energia_reativa;
        $dados->energia_ativa = $energia_ativa;

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
        $mensagem->from = $this->get_user($from)[0];

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
        $new_subordinado = $this->get_user($from)[0];
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
            return new PDO($this->source, CONFIG['db_user'], CONFIG['db_password']);
        } catch(PDOException $e) {
            return null;
        }
    }
}

?>