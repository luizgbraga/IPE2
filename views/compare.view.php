<!DOCTYPE html>

<html lang='pt-br'>

    <head>

        <meta charset='UTF-8'>
        <title>Comparação</title>

        <style>
            <?php include 'styles/default.style.css'; ?>
            <?php include 'styles/header.style.css'; ?>
            <?php include 'styles/compare.style.css'; ?>
            <?php include 'styles/nav.style.css'; ?>
            <?php include 'styles/modal.style.css'; ?>
        </style>

        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Nunito'>
        <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

    </head>

    <body>

        <?php include 'header.view.php'; ?>

        <div class='row-sided row'>

            <?php $compare_nav = true; ?>
            <?php include 'nav.view.php'; ?>

            <div class='column'>

                <h2 class='main-title-page'>Comparar subordinados</h2>

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

                <div class='content'>

                    <form method='get' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    
                        <label class='select-label-cmp' for="subordinados">Selecione os subordinados</label>

                        <select name="subordinados-cmp" multiple="multiple" id='subordinados-cmp'>

                            <?php

                                foreach($subordinados as $subordinado) {
                                $id = $subordinado->id;
                                $nome = $subordinado->name;
                                $sigla = $subordinado->sigla;

                                    echo "<option name='subordinado-option' value='$id'>$sigla</option>";
                                }

                            ?>

                        </select>

                        <input class='see-cmp-btn' type="submit" value="Ver dados">

                    </form>

                </div>

                <?php } ?>

                <?php include 'modal.view.php'; ?>

            </div>

        </div>

    </body>

    <script>
        <?php include 'scripts/modal.js'; ?>
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
<script>
    $(function() {
        $('select').multipleSelect({
        selectAll: false
        })
    })
</script>

</html>