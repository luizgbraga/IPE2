<!DOCTYPE html>

<html lang="pt-br">

  <head>

    <title>Home</title>
    <meta charset="utf-8">

    <style>
      <?php include 'styles/default.style.css'; ?>
      <?php include 'styles/header.style.css'; ?>
      <?php include 'styles/welcome.style.css'; ?>
      <?php include 'styles/nav.style.css'; ?>
      <?php include 'styles/modal.style.css'; ?>
      <?php include 'styles/boxinfo.style.css'; ?>
    </style>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">

  </head>

  <body>

    <?php include 'header.view.php'; ?>

    <div class="row-sided row">

      <?php $home_nav = true; ?>
      <?php include 'nav.view.php'; ?>

      <div class='column'>

        <section>

          <div class='row'>

            <div class="chart-demanda">
              <h2 class='title-chart'>Demanda medida</h2>
              <canvas id="chart-demanda-medida"></canvas>
            </div>

            <div class='demanda-infos'>
              <div class='box-info'>
                <img src="assets/yellow-warning.png" class='yellow-warning-img' alt="yellow-warning" width="36" height="36" />
                <div class='color-info-red'></div>
                <div class='box-text'>
                  <p class='box-title'>Demanda contratada atual</p>
                  <p class='box-number'><?= $demanda_contratada ?> kWh</p>
                </div>
              </div>
              <div class='box-info'>
                <div class='color-info-green'></div>
                <div class='box-text'>
                  <p class='box-title'>Demanda contratada ótima</p>
                  <p class='box-number'><?= $optimal_demanda ?> kWh</p>
                </div>
              </div>
              <div class='percentage-info'>
                <div class='color-info-red-percentage'></div>
                <div class='box-text'>
                  <p class='box-title'>Ultrapassagem <span class='percentual-info'><?= $percentual_ultrapassagem ?>%</span></p>
                </div>
              </div>
            </div>

          </div> 

          <div class='row'>

            <div class="chart-consumo">
              <h2 class='title-chart'>Consumo</h2>
              <canvas id="chart-consumo"></canvas>
            </div>

            <div>

              <div class='consumo-infos'>
                <div class='box-info'>
                  <div class='color-info-blue'></div>
                  <div class='box-text'>
                    <p class='box-title'>Consumo médio por efetivo</p>
                    <p class='box-number'><?= $consumo_medio_por_efetivo ?> kWh</p>
                  </div>
                </div>
              </div>

              <div class='energia-reativa-info'>
                <div class='box-info'>
                <img src="assets/yellow-warning.png" class='yellow-warning-img' alt="yellow-warning" width="36" height="36" />
                  <div class='color-info-yellow'></div>
                  <div class='box-text'>
                    <p class='box-title'>Energia reativa média</p>
                    <p class='box-number'><?= $energia_reativa_media ?> kVAh</p>
                  </div>
                </div>
              </div>

            </div>

            <div>

              <div class='consumo-infos'>
                <div class='fp-info'>
                  <div class='color-info-grey'></div>
                  <div class='box-text'>
                    <p class='box-title'>Fator de potência médio</p>
                    <p class='box-number'><?= $fp_medio ?></p>
                  </div>
                </div>
              </div>

            </div>

          </div> 
        
        </section>
      </div>

      <?php include 'modal.view.php'; ?>

    </div>


  </body>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const labels = <?php echo json_encode($datas) ?>;
    const consumoJSON = <?php echo json_encode($all_consumo) ?>;
    const demandaJSON = <?php echo json_encode($all_demanda_medida) ?>;
    const secundaryJSON = <?php echo json_encode($sec_inputs) ?>;
    const optimalDemanda = <?php echo $optimal_demanda ?>;

    <?php include 'scripts/data.js'; ?>
    <?php include 'scripts/modal.js'; ?>
  </script>

</html>