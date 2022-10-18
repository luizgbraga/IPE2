<!DOCTYPE html>

<html lang="pt-br">

  <head>

    <title>Subordinados</title>
    <meta charset="utf-8">

    <style>
      <?php include 'styles/default.style.css'; ?>
      <?php include 'styles/header.style.css'; ?>
      <?php include 'styles/subordinados.style.css'; ?>
      <?php include 'styles/nav.style.css'; ?>
      <?php include 'styles/modal.style.css'; ?>
    </style>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">

  </head>

  <body>

    <?php include 'header.view.php'; ?>

    <div class="row-sided row">

      <?php $home_nav = false; $mensagens_nav = false; $adicionar_subordinado_nav = false; $profile_nav = false; $subordinados_nav = true; ?>
      <?php include 'nav.view.php'; ?>

      <section>

        <h2 class='main-title-page'>Subordinados</h2>

        <?php 
        $counter = 0;
        foreach($subordinados as $subordinado) {
          $counter += 1;
        }
        ?>

        <div <?php if($counter === 0) {
          echo "class='centered-content'";
        } ?> >

          <?php if($counter === 0) { ?>
            <p class='empty-subordinados-text'>Não há subordinados</p>
          <?php } else { ?>

            <form method='get' class='select-subordinado-form' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label class='select-label' for="subordinados">Selecione um subordinado</label>
                    <select name="subordinados" id="subordinados">
                        <?php

                            foreach($subordinados as $subordinado) {
                            $id = $subordinado->id;
                            $nome = $subordinado->name;
                            $sigla = $subordinado->sigla;

                                echo "<option name='subordinado-option' value='$id'>$sigla</option>";
                            }

                        ?>
                    </select>
                <input class='see-data-btn' type="submit" value="Ver dados">
            </form>

            <section class='row content'>

              <div class="chart-test">
                <h2 class='title-chart'>Consumo</h2>
                <canvas id="chart-consumo"></canvas>
              </div>

              <div class="chart-test">
                <h2 class='title-chart'>Demanda medida</h2>
                <canvas id="chart-demanda-medida"></canvas>
              </div>

            </section>

          <?php } ?>

        </div>

        <?php include 'modal.view.php'; ?>

      </section>

    </div>

  </body>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const labels = <?php echo json_encode($datas_sub) ?>;
    const consumoJSON = <?php echo json_encode($all_consumo_sub) ?>;
    const demandaJSON = <?php echo json_encode($all_demanda_medida_sub) ?>;

    <?php include 'scripts/data.js'; ?>
    <?php include 'scripts/modal.js'; ?>
  </script>

</html>