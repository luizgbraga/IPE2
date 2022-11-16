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

            <?php $profile_nav = true; ?>
            <?php include 'nav.view.php'; ?>

            <section>

                <h2 class='main-title-page'>Configurações do usuário</h2>

                <div class='dados-usuario-form row'>
                  <div class='column'>
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

                        <?php if($editable != 1) { ?>
                          <div class='infos'>
                              <div class='row'>
                                <p class='item'><strong>Efetivo: </strong><?php echo value($sec[0]) ?></p>
                                <?php if($profile_warnings[0] == 'Não há') {
                                  echo "<img class='warning-profile' src='assets/warning.png' width='16' height='16'>";
                                } ?>
                              </div>
                              <div class='row'>
                                <p class='item'><strong>Metragem: </strong><?php echo value($sec[1]) ?></p>
                                <?php if($profile_warnings[1] == 'Não há') {
                                  echo "<img class='warning-profile' src='assets/warning.png' width='16' height='16'>";
                                } ?>
                              </div>
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

                            </div>

                          </form>
                        <?php }  ?>
                    </div>
                  </div>

                  <div class='energetic-info'>
                    <div class='title-box row'>
                            <h3>Perfil Energético da OM</h3>
                            <a id="edit" href="profile.php?editable=2">
                              <img src="assets/edit.png" alt="edit-icon" width="22" height="22" />
                            </a>
                        </div>

                      
                        <?php if($editable != 2) { ?>
                          <div class='infos'>
                      <p class='item'><strong>Grupo:</strong> <?= $_SESSION["nome"] ?></p>
                      <p class='item'><strong>Subgrupo:</strong> <?= $_SESSION["sigla"] ?></p>
                      <p class='item'><strong>Tarifa:</strong> <?= $_SESSION["username"] ?></p>
                      <p class='item'><strong>Demanda contratada (úmido):</strong> <?= $_SESSION["password"] ?></p>
                      <p class='item'><strong>Demanda contratada (seco):</strong> <?= $_SESSION["password"] ?></p>
                    </div>
                        <?php }  else { ?>
                          <form id='secundary' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                          
                            <div class='infos'>
                              <div class='row'>
                                <p class='item'>Grupo:</p>
                                <select>
                                  <option>A</option>
                                  <option>B</option>
                                </select>
                              </div>

                              <div class='row'>
                                <p class='item'>Subgrupo:</p>
                                <select>
                                  <option>A</option>
                                  <option>B</option>
                                </select>
                              </div>

                              <div class='row'>
                                <p class='item'>Tarifa:</p>
                                <select>
                                  <option>Horossazonal verde</option>
                                  <option>Horossazonal azul</option>
                                </select>
                              </div>

                              <div class='row'>
                                <p class='item'>Demanda contratada (úmido):</p>
                                <input type='number' name='metragem' value=<?php echo value($sec[1]) ?> class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item'>Demanda contratada (seco):</p>
                                <input type='number' name='metragem' value=<?php echo value($sec[1]) ?> class='sec-input'>
                              </div>

                            </div>

                          </form>
                        <?php }  ?>


                  </div>
                </div>

                <div class=' submit-form row'>
                  <button type="submit" class='btn-salvar' form="secundary">Salvar alterações</button>
                    <a id="edit" href="profile.php?editable=0">
                      <p class='btn-cancel center-content'>Cancelar</p>
                    </a>
                </div>
                
                <?php include 'modal.view.php'; ?>

            </section>
        </div>
        
    </body>

    <script>
      <?php include 'scripts/modal.js'; ?>
    </script>

</html>