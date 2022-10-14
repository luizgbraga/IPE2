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
        <h2>Suas mensagens</h2>

        <?php

        foreach($mensagens as $item) {
        $from = $item->from->id;
        $name = $item->from->nome;
        $sigla = $item->from->sigla;

            echo "<p>Mensagem de $name ($sigla) - <a href=accept.php?id=$id&from=$from>Aceitar</a></p>";
        }

        ?>
    </div>
</body>
</html>