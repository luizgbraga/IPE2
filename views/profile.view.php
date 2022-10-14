<!DOCTYPE html>

<?php

if(empty($_GET['editable'])) {
  $editable = 0;
} else {
  $editable = $_GET['editable'];
}

?>

<html lang="pt-br">

    <head>
        <title>Home</title>
        <meta charset="utf-8">
        <style>
          <?php include 'styles/profile.style.css'; ?>
        </style>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    </head>

    <body>

      <header>
          <div class='first-part-header'>
            <div class='logo-img'></div>
            <div class='name'>
              <h2>Bem vindo, <?php echo $_SESSION["sigla"]; ?></h2>
            </div>
          </div>
            <div class="actions-header">
                <a href='mensagens.php'><img src='assets/bell.png' width="26" height="26"></a>
                <a href=''><img src='assets/question.png' width="26" height="26"></a>
                <a href='logout.php'><img src='assets/logout.png' width="26" height="26"></a>
                <a href='profile.php'><img src='assets/colored-user.png' width="36" height="36"></a>
            </div>
        </header>

        <div class="row-sided">
            <nav>
                <div class="actions-nav">

                  <div>

                    <div class='dir-row'>
                        <img src='assets/home.png' width="20" height="20">
                        <a href='welcome.php'><p class="action-nav">Início</p></a>
                    </div>

                    <div class='dir-row'>
                      <img src='assets/add-input.png' width="20" height="20">
                      <a href='inputs.php'><p class="action-nav">Novo Input</p></a>
                    </div>

                    <div class='dir-row'>
                      <img src='assets/chat.png' width="20" height="20">
                      <a href='mensagens.php'><p class="action-nav">Mensagens</p></a>
                    </div>
                    
                    <div class='dir-row'>
                      <img src='assets/add-user.png' width="20" height="20">
                      <a href='acesslevel.php'><p class="action-nav">Adicionar subordinado</p></a>
                    </div>
                  
                  </div>

                  <div class='dir-row settings'>
                    <img src='assets/setting.png' width="20" height="20">
                    <a href=''><p class="action-nav">Configurações</p></a>
                  </div>

                </div>
            </nav>

            <section>

                <h2 class='title'>Configurações do usuário</h2>

                <div class='data-form'>
                    <div class='primary-info'>
                        <div class='subtitle'>
                            <h3>Informações da conta</h3>
                            <img src="assets/edit.png" alt="edit-icon" width="22" height="22" />
                        </div>
                        <div class='infos'>
                            <p class='item'><strong>Nome:</strong> <?= $_SESSION["nome"] ?></p>
                            <p class='item'><strong>Sigla:</strong> <?= $_SESSION["sigla"] ?></p>
                            <p class='item'><strong>Login:</strong> <?= $_SESSION["username"] ?></p>
                            <p class='item'><strong>Senha:</strong> <?= $_SESSION["password"] ?></p>
                        </div>
                    </div>

                    <div class='secundary-info'>
                        <div class='subtitle'>
                            <h3>Informações da OM</h3>
                            <a id="edit" href="profile.php?editable=1">
                              <img src="assets/edit.png" alt="edit-icon" width="22" height="22" />
                            </a>
                        </div>

                        <?php if(!$editable) { ?>
                          <div class='infos'>
                              <p class='item'><strong>Efetivo: </strong><?php echo value($sec[0]) ?></p>
                              <p class='item'><strong>Metragem: </strong><?php echo value($sec[1]) ?></p>
                              <p class='item'><strong>Demanda: </strong><?php echo value($sec[2]) ?></p>
                              <p class='item'><strong>Modalidade: </strong><?php echo value($sec[3]) ?></p>
                          </div>
                        <?php }  else { ?>
                          <form id='secundary' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                          
                            <div class='infos'>
                              <div class='row'>
                                <p class='item'>Efetivo:</p>
                                <input type='number' name='efetivo' class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item'>Metragem:</p>
                                <input type='number' name='metragem' class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item'>Demanda:</p>
                                <input type='number' name='demanda' class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item'>Modalidade:</p>
                                <input type='text' name='modalidade' class='sec-input'>
                              </div>
                            </div>

                          </form>
                        <?php }  ?>
                    </div>

                    <div class='row'>
                      <button type="submit" class='btn' form="secundary">Salvar alterações</button>
                        <a id="edit" href="profile.php?editable=0">
                          <p class='cancel'>Cancelar</p>
                        </a>
                    </div>
                </div>
            </section>
        </div>
        
    </body>
</html>