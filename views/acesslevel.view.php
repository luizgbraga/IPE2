<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Procure uma OM</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <div class="form-group">
                <label>Procure uma OM</label>
                <input type="text" name="search" class="form-control <?php echo (!empty($search_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $search; ?>">
                <span class="invalid-feedback"><?php echo $search_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Pesquisar">
            </div>
        </form>

        <?php

        foreach($users as $item) {
        $nome = $item->nome;
        $sigla = $item->sigla;
        $id = $item->id;
        $from = $_SESSION['id'];

        if($id === $from) {
            echo "<p>$nome ($sigla) - Sua OM</p>";
        } else {
            echo "<p>$nome ($sigla) - <a href=send_message.php?id=$id&from=$from>Enviar solicitação</a></p>";
        }
        }

        ?>
    </div>
</body>
</html>