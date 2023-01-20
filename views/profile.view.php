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
                            <img src="../assets/edit.png" alt="edit-icon" width="22" height="22" />
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
                              <img src="../assets/edit.png" alt="edit-icon" width="22" height="22" />
                            </a>
                        </div>

                        <?php if($editable != 1) { ?>
                          <div class='infos'>
                              <div class='row'>
                                <p class='item'><strong>Efetivo: </strong><?php echo value($sec['efetivo']) ?></p>
                                <?php if($profile_warnings['efetivo'] == 'Não há') {
                                  echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                                } ?>
                              </div>
                              <div class='row'>
                                <p class='item'><strong>Metragem: </strong><?php echo value($sec['metragem']) ?></p>
                                <?php if($profile_warnings['metragem'] == 'Não há') {
                                  echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                                } ?>
                              </div>
                          </div>
                        <?php }  else { ?>
                          <form id='secundary' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type='hidden' name='form-name' value='secundary'>
                            <div class='infos'>
                              <div class='row'>
                                <p class='item'>Efetivo:</p>
                                <input type='number' name='efetivo' value=<?php echo value($sec['efetivo']) ?> class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item'>Metragem:</p>
                                <input type='number' name='metragem' value=<?php echo value($sec['metragem']) ?> class='sec-input'>
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
                              <img src="../assets/edit.png" alt="edit-icon" width="22" height="22" />
                            </a>
                        </div>

                      
                        <?php if($editable != 2) { ?>
                          <div class='infos'>
                            <div class='row'>
                              <p class='item'><strong>Concessionária:</strong> <?= value($en['concessionaria']) ?></p>
                              <?php if($energetic_warnings['concessionaria'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>
                            <div class='row'>
                              <p class='item'><strong>Grupo:</strong> <?= value($en['grupo']) ?></p>
                              <?php if($energetic_warnings['grupo'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>
                            <div class='row'>
                              <p class='item'><strong>Subgrupo:</strong> <?= value($en['subgrupo']) ?></p>
                              <?php if($energetic_warnings['subgrupo'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>
                            <div class='row'>
                              <p class='item'><strong>Modalidade tarifária:</strong> <?= value($en['modalidade']) ?></p>
                              <?php if($energetic_warnings['modalidade'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>

                            <?php if(value($en['modalidade']) == 'azul') { ?>
                              <div class='row'>
                              <p class='item'><strong>Demanda contratada (seco ponta):</strong> <?= value($en['demanda_sp']) ?></p>
                              <?php if($energetic_warnings['demanda_sp'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>
                            <div class='row'>
                              <p class='item'><strong>Demanda contratada (úmido ponta):</strong> <?= value($en['demanda_up']) ?></p>
                              <?php if($energetic_warnings['demanda_up'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>                            
                            <div class='row'>
                              <p class='item'><strong>Demanda contratada (seco fora):</strong> <?= value($en['demanda_sfp']) ?></p>
                              <?php if($energetic_warnings['demanda_sp'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>
                            <div class='row'>
                              <p class='item'><strong>Demanda contratada (úmido fora):</strong> <?= value($en['demanda_ufp']) ?></p>
                              <?php if($energetic_warnings['demanda_up'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>

                            <?php } else { ?>

                            <div class='row'>
                              <p class='item'><strong>Demanda contratada (seco):</strong> <?= value($en['demanda_sp']) ?></p>
                              <?php if($energetic_warnings['demanda_sp'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>
                            <div class='row'>
                              <p class='item'><strong>Demanda contratada (úmido):</strong> <?= value($en['demanda_up']) ?></p>
                              <?php if($energetic_warnings['demanda_up'] == 'Não há') {
                                    echo "<img class='warning-profile' src='../assets/warning.png' width='16' height='16'>";
                              } ?>
                            </div>

                            <?php } ?>
                            <div class='row'>
                              <p class='item-switch'><strong>Possui subordinados:</strong> <?= translator($sec['possui_subordinados']) ?></p>
                            </div>
                            <div class='row'>
                              <p class='item'><strong>Possui geração distribuída:</strong> <?= translator($sec['possui_gerdistr']) ?></p>
                            </div>
                          </div>
                        <?php }  else { ?>
                          <form id='energetic' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type='hidden' name='form-name' value='energetic'>
                            <div class='infos'>

                              <div class='row'>
                                <p class='item'>Concessionária:</p>
                                <input type='text' name='concessionaria' value=<?php echo value($en['concessionaria']) ?> class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item'>Grupo:</p>
                                <select class='sec-input' name='grupo'>
                                  <option value='A'>A</option>
                                  <option value='B'>B</option>
                                </select>
                              </div>

                              <div class='row'>
                                <p class='item'>Subgrupo:</p>
                                <select class='sec-input' name='subgrupo'>
                                  <option value='A1'>A1</option>
                                  <option value='A2'>A2</option>
                                  <option value='A3'>A3</option>
                                  <option value='A3a'>A3a</option>
                                  <option value='A4'>A4</option>
                                </select>
                              </div>

                              <div class='row'>
                                <p class='item'>Modalidade tarifária:</p>
                                <select class='sec-input' name='modalidade' value=<?php echo $en['modalidade'] ?> id='modalidade'>
                                
                                <?php if($en['modalidade'] === 'verde') { ?>
                                  <option value='verde' selected>Verde</option>
                                  <option value='azul'>Azul</option>
                                <?php } else { ?>
                                  <option value='verde'>Verde</option>
                                  <option value='azul' selected>Azul</option>
                                <?php } ?>
                                </select>
                              </div>


                              <div class='row verde'>
                                <p class='item'>Demanda contratada (seco):</p>
                                <input type='number' name='demanda_sp' value=<?php echo value($en['demanda_sp']) ?> class='sec-input'>
                              </div>

                              <div class='row verde'>
                                <p class='item'>Demanda contratada (úmido):</p>
                                <input type='number' name='demanda_up' value=<?php echo value($en['demanda_up']) ?> class='sec-input'>
                              </div>

                              <div class='row azul'>
                                <p class='item'>Demanda contratada (ponta-seco):</p>
                                <input type='number' name='demanda_sp_azul' value=<?php echo value($en['demanda_sp']) ?> class='sec-input'>
                              </div>

                              <div class='row azul'>
                                <p class='item'>Demanda contratada (ponta-úmido):</p>
                                <input type='number' name='demanda_up_azul' value=<?php echo value($en['demanda_up']) ?> class='sec-input'>
                              </div>
                              
                              <div class='row azul'>
                                <p class='item'>Demanda contratada (fora-seco):</p>
                                <input type='number' name='demanda_sfp' value=<?php echo value($en['demanda_sfp']) ?> class='sec-input'>
                              </div>

                              <div class='row azul'>
                                <p class='item'>Demanda contratada (fora-úmido):</p>
                                <input type='number' name='demanda_ufp' value=<?php echo value($en['demanda_ufp']) ?> class='sec-input'>
                              </div>

                              <div class='row'>
                                <p class='item-switch'>Possui subordinados</p>
                                <label class="switch">
                                  <input type="checkbox" name='possui_subordinados'>
                                  <span class="slider round"></span>
                                </label>
                              </div>

                              <div class='row'>
                                <p class='item'>Possui geração distribuída</p>
                                <label class="switch-gd">
                                  <input type="checkbox" name='possui_gerdistr'>
                                  <span class="slider round"></span>
                                </label>
                              </div>

                            </div>

                          </form>
                        <?php }  ?>

                  </div>
                </div>

                <?php if($editable == 1) { ?>
                  <div class=' submit-form row'>
                  <button type="submit" class='btn-salvar' form="secundary">Salvar alterações</button>
                    <a id="edit" href="profile.php?editable=0">
                      <p class='btn-cancel center-content'>Cancelar</p>
                    </a>
                  </div>
                <?php } else if($editable == 2) { ?>
                  <div class=' submit-form row'>
                  <button type="submit" class='btn-salvar' form="energetic">Salvar alterações</button>
                    <a id="edit" href="profile.php?editable=0">
                      <p class='btn-cancel center-content'>Cancelar</p>
                    </a>
                  </div>
                <?php } else { ?>
                  <div class=' submit-form row'>
                  <button class='btn-salvar'>Salvar alterações</button>
                    <a id="edit" href="profile.php?editable=0">
                      <p class='btn-cancel center-content'>Cancelar</p>
                    </a>
                  </div>
                <?php } ?>

                <?php include 'modal.view.php'; ?>

            </section>
        </div>
        
    </body>


    <script>
        <?php if($en_inputs['modalidade'] === 'verde') {
            include 'scripts/modal.js';
        }  else {
            include 'scripts/modalAzul.js'; 
        }
        ?>
    </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script>
      if($('#modalidade option:selected').text() == 'Verde') {
        $('.verde').show();
        $('.azul').hide();
      } else {
        $('.verde').hide();
        $('.azul').show();
      }

    $('#modalidade').change(function () {
        var selected = $('#modalidade option:selected').text();
        console.log(selected)
        if(selected == 'Verde') {
          $('.verde').show();
          $('.azul').hide();
        } else {
          $('.verde').hide();
          $('.azul').show();
        }
    });

    </script>

</html>