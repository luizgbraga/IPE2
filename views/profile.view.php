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
        <title>Perfil</title>
        <meta charset="utf-8">

        <style>
          <?php include 'styles/default.style.css'; ?>
          <?php include 'styles/header.style.css'; ?>
          <?php include 'styles/profile.style.css'; ?>
          <?php include 'styles/nav.style.css'; ?>
          <?php include 'styles/modal.style.css'; ?>
        </style>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    </head>

    <body>

      <?php include 'header.view.php'; ?>

        <div class="row-sided row">

            <?php $home_nav = false; $mensagens_nav = false; $adicionar_subordinado_nav = false; $profile_nav = true; ?>
            <?php include 'nav.view.php'; ?>

            <section>

                <h2 class='main-title-page'>Configurações do usuário</h2>

                <div class='dados-usuario-form'>
                    <div class='primary-info column'>
                        <div class='title-box row'>
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

                    <div class='secundary-info column'>
                        <div class='title-box row'>
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
                                <input type='number' name='efetivo' value=<?php echo value($sec[0]) ?> class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item'>Metragem:</p>
                                <input type='number' name='metragem' value=<?php echo value($sec[1]) ?> class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item'>Demanda:</p>
                                <input type='number' name='demanda'value=<?php echo value($sec[2]) ?> class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item'>Modalidade:</p>
                                <input type='text' name='modalidade'value=<?php echo value($sec[3]) ?> class='sec-input'>
                              </div>
                            </div>

                          </form>
                        <?php }  ?>
                    </div>

                    <div class='row'>
                      <button type="submit" class='btn-salvar' form="secundary">Salvar alterações</button>
                        <a id="edit" href="profile.php?editable=0">
                          <p class='btn-cancel'>Cancelar</p>
                        </a>
                    </div>
                </div>
                
                <?php include 'modal.view.php'; ?>

            </section>
        </div>
        
    </body>

    <script>
      <?php include 'scripts/modal.js'; ?>
    </script>

</html>