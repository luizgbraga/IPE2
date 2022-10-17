<!DOCTYPE html>

<html lang="pt-br">

  <head>

    <title>Home</title>
    <meta charset="utf-8">

    <style>
      <?php include 'styles/welcome.style.css'; ?>
      <?php include 'styles/modal.style.css'; ?>
    </style>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">

  </head>

  <body>

    <?php include 'header.view.php'; ?>

    <div class="row-sided">

      <?php include 'nav.view.php'; ?>

      <section>
        <div class="chart-test">
          <canvas id="myChart"></canvas>
        </div>
      </section>

      <?php include 'modal.view.php'; ?>

    </div>

  </body>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const labels = <?php echo json_encode($datas) ?>;
    const dataJSON = <?php echo json_encode($all_consumo) ?>;
    const allDataJSON = <?php echo json_encode($subordinados_inputs) ?>;

    <?php include 'scripts/data.js'; ?>
    <?php include 'scripts/modal.js'; ?>
  </script>

</html>