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
          <?php include 'styles/modal.style.css'; ?>
        </style>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    </head>

    <body>

      <?php include 'header.view.php'; ?>

        <div class="row-sided">

            <?php include 'nav.view.php'; ?>

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
                      <button type="submit" class='btn' form="secundary">Salvar alterações</button>
                        <a id="edit" href="profile.php?editable=0">
                          <p class='cancel'>Cancelar</p>
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