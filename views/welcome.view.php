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

        <div class='energetic-profile'>

          <h2 class='title-profile'>Perfil energético - <?= strtoupper($en_inputs['modalidade']); ?></h2>

          <div class='row'>

            <div class='primary-infos'>
              <p>Nome: <?= $_SESSION['sigla']; ?></p>
              <p>Concessionária: <?= $en_inputs['concessionaria']; ?></p>
              <p>Grupo: <?= $en_inputs['grupo']; ?></p>
              <p>Subgrupo: <?= $en_inputs['subgrupo']; ?></p>
            </div>

            <div class='row'>


              <?php if($en_inputs['modalidade'] === 'verde') { ?>

                <div class='demandas'>
                  <p>Dem. contratada (úmido)</p>
                  <p class='value-demanda'><?= $en_inputs['demanda_up']; ?> kW</p>
                </div>

                <div class='demandas'>
                  <p>Dem. contratada (seco)</p>
                  <p class='value-demanda'><?= $en_inputs['demanda_sp']; ?> kW</p>
                </div>


              <?php } else if($en_inputs['modalidade'] === 'azul') { ?>

                <div class='demandas'>
                  <p>Dem. cont. (úmido, ponta)</p>
                  <p class='value-demanda'><?= $en_inputs['demanda_up']; ?> kW</p>
                </div>

                <div class='demandas'>
                  <p>Dem. cont. (seco, ponta)</p>
                  <p class='value-demanda'><?= $en_inputs['demanda_sp']; ?> kW</p>
                </div>

                <div class='demandas'>
                  <p>Dem. cont. (úmido, fora)</p>
                  <p class='value-demanda'><?= $en_inputs['demanda_ufp']; ?> kW</p>
                </div>

                <div class='demandas'>
                  <p>Dem. cont. (seco, fora)</p>
                  <p class='value-demanda'><?= $en_inputs['demanda_sfp']; ?> kW</p>
                </div>

              <?php } ?>
                
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
                  <p class='box-title'>Consumo total</p>
                  <p class='box-number'><?= $sum_consumo ?> kWh</p>
                </div>
              </div>
            </div>

            <div>
              <div class='box-info-down'>
                <div class='color-info-blue'></div>
                <div class='box-text'>
                  <p class='box-title'>Consumo médio por efetivo</p>
                  <p class='box-number'><?= $consumo_medio_por_efetivo ?> kWh</p>
                </div>
              </div>
            </div>

          </div>

          <div>

            <div class='consumo-infos'>
              <div class='box-info'>
                <div class='color-info-yellow'></div>
                <div class='box-text'>
                  <p class='box-title'>Energia reativa média</p>
                  <p class='box-number'><?= $energia_reativa_media ?> kVA</p>
                </div>
              </div>
            </div>

            <div>
          
              <div class='box-info-down'>
                <div class='color-info-yellow'></div>
                  <div class='box-text'>
                    <p class='box-title'>Fator de potência</p>
                    <p class='box-number'><?= $fp_medio ?></p>
                  </div>
                </div>
              </div>
  
            </div>

          </div>

          <div class='row'>

            <div class="chart-demanda">
              <h2 class='title-chart'>Demanda medida</h2>
              <canvas id="chart-demanda-medida"></canvas>
            </div>

            <div>

              <?php if($modalidade == 'verde') { ?>


                <div class='demanda-infos'>
                  <div class='box-info'>
                    <div class='color-info-green'></div>
                    <div class='box-text'>
                      <p class='box-title'>Demanda Ótima (seco)</p>
                      <p class='box-number'><?= $optimal_demanda_s ?> kW</p>
                    </div>
                  </div>
                </div>

                <div>
                  <div class='box-info'>
                    <div class='color-info-green'></div>
                    <div class='box-text'>
                      <p class='box-title'>Demanda Ótima (úmido)</p>
                      <p class='box-number'><?= $optimal_demanda_u ?> kW</p>
                    </div>
                  </div>
                </div>


              <?php } else { ?>


                <div class='demanda-infos'>
                  <div class='box-info'>
                    <div class='color-info-green'></div>
                    <div class='box-text'>
                      <p class='box-title'>Dem. Ótima (seco): Ponta - Fora</p>
                      <p class='box-number'><?= $optimal_demanda_seco_p . ' - ' . $optimal_demanda_seco_fp ?> kW</p>
                    </div>
                  </div>
                </div>

                <div>
                  <div class='box-info'>
                    <div class='color-info-green'></div>
                    <div class='box-text'>
                      <p class='box-title'>Dem. Ótima (úmido): Ponta - Fora</p>
                      <p class='box-number'><?= $optimal_demanda_umido_p . ' - ' . $optimal_demanda_umido_fp ?> kW</p>
                    </div>
                  </div>
                </div>


              <?php } ?>

            </div>

            <div>

              <div class='demanda-infos'>
                <div class='box-info'>
                  <div class='color-info-blue'></div>
                  <div class='box-text'>
                    <p class='box-title'>Percentual de ultrapassagem</p>
                    <p class='box-number'><?= $average_trepass ?> %</p>
                  </div>
                </div>
              </div>

              <div>
                <div class='box-info'>
                  <div class='color-info-blue'></div>
                  <div class='box-text'>
                    <p class='box-title'>Valor pago em multas</p>
                    <p class='box-number'><?= $multa_total ?> R$</p>
                  </div>
                </div>
              </div>
  
            </div>

          </div>

            </div>

          </div> 
        
        </section>
      </div>

      <?php include 'modal.view.php'; 
      ?>

    </div>


  </body>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    <?php if(!$datas) { ?>
      const labels = [];
    <?php } else { ?>
      const labels = <?php echo json_encode($datas) ?>;
    <?php } ?>

    <?php if(!$all_consumo_p) { ?>
      const consumoPJSON = [];
    <?php } else { ?>
      const consumoPJSON = <?php echo json_encode($all_consumo_p) ?>;
    <?php } ?>

    <?php if(!$all_consumo_fp) { ?>
      const consumoFPJSON = [];
    <?php } else { ?>
      const consumoFPJSON = <?php echo json_encode($all_consumo_fp) ?>;
    <?php } ?>

    <?php if($en_inputs['modalidade'] === 'verde') { ?>

      <?php if(!$all_demanda_medida_p) { ?>
        const demandaJSON = [];
      <?php } else { ?>
        const demandaJSON = <?php echo json_encode($all_demanda_medida_p) ?>;
      <?php } ?>

      <?php if(!$en_inputs) { ?>
        const demandaContratadaU = 0;
        const demandaContratadaS = 0
      <?php } else { ?>
        const demandaContratadaU = <?php echo $en_inputs['demanda_up'] ?>;
        const demandaContratadaS = <?php echo $en_inputs['demanda_sp'] ?>;
      <?php } ?>

      const optimalDemandaS = <?php echo $optimal_demanda_s ?>;
      const optimalDemandaU = <?php echo $optimal_demanda_u ?>;

    <?php } else { ?>

      <?php if(!$all_demanda_medida_p) { ?>
        const demandaJSON = [];
      <?php } else { ?>
        const demandaJSON = <?php echo json_encode($all_demanda_medida_p) ?>;
      <?php } ?>

      <?php if(!$all_demanda_medida_fp) { ?>
        const demandaFPJSON = [];
      <?php } else { ?>
        const demandaFPJSON = <?php echo json_encode($all_demanda_medida_fp) ?>;
      <?php } ?>

      <?php if(!$en_inputs) { ?>
        const demandaContratadaUPonta = 0;
        const demandaContratadaSPonta = 0;
        const demandaContratadaUForaPonta = 0;
        const demandaContratadaSForaPonta = 0
      <?php } else { ?>
        const demandaContratadaUPonta = <?php echo $en_inputs['demanda_up'] ?>;
        const demandaContratadaSPonta = <?php echo $en_inputs['demanda_sp'] ?>;
        const demandaContratadaUForaPonta = <?php echo $en_inputs['demanda_ufp'] ?>;
        const demandaContratadaSForaPonta = <?php echo $en_inputs['demanda_sfp'] ?>;
      <?php } ?>

      const optimalDemandaSecoPonta = <?php echo $optimal_demanda_seco_p ?>;
      const optimalDemandaSecoFora = <?php echo $optimal_demanda_seco_fp ?>;
      const optimalDemandaUmidoPonta = <?php echo $optimal_demanda_umido_p ?>;
      const optimalDemandaUmidoFora = <?php echo $optimal_demanda_umido_fp ?>;

    <?php } ?>

    const modalidade = "<?php echo $en_inputs['modalidade']; ?>"

    <?php include 'scripts/data.js'; ?>
    <?php if($en_inputs['modalidade'] === 'verde') {
      include 'scripts/modal.js';
    }  else {
      include 'scripts/modalAzul.js'; 
    }
    ?>
  </script>

</html>