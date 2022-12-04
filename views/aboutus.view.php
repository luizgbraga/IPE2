<!DOCTYPE html>

<html lang='pt-br'>

    <head>

        <meta charset='UTF-8'>
        <title>Sobre nós</title>

        <style>
            <?php include 'styles/default.style.css'; ?>
            <?php include 'styles/header.style.css'; ?>
            <?php include 'styles/nav.style.css'; ?>
            <?php include 'styles/aboutus.style.css'; ?>
            <?php include 'styles/modal.style.css'; ?>
        </style>

        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Nunito'>

    </head>

    <body>

        <?php include 'header.view.php'; ?>

        <div class='row-sided row'>

            <?php include 'nav.view.php'; ?>

            <div class='column'>

                <h2 class='main-title-page'>Sobre nós</h2>

                <div class='content-about'>

                    <p class='about-text'>Somos uma empresa onde buscamos tornar acessível a todos o controle do balanço energético de uma organização ou estabelecimento. Para isso, desenvolvemos algoritmos matemáticos de otimização energética, sugestões prescritivas para redução de multas futuras, visualização intuitiva dos principais dados energéticos de sua empresa, entre muitas outras ferramentas. E como fazemos isso? Eis o nosso diferencial: nossa interface é amigável e simples, de modo que qualquer usuário é capaz de acessá-la e aproveitá-la em seu máximo.</p>
                    <br>
                    <p class='about-text'>Prezamos, em primeiro lugar, pelos nossos clientes. Por isso, democratizamos o acesso a um ambiente fácil para reunir seu balanço energético em um só lugar. Sem necessidade de consultoria humana, o software é capaz de indicar qual o melhor modelo de contrato com sua concessionária, a fim de reduzir ao máximo os gastos e multas. Será que a melhor tarifa para o meu estabelecimento de fato é a horossazonal verde? Ou ainda, será que eu tenho a necessidade de instalar um banco de capacitores para aumento do fator de potência? Ou pior: será que não existe uma melhor demanda a ser contratada para reduzir ao máximo as multas mensalmente? Não se preocupe com as terminologias complicadas, a Amber veio para ajudar!</p>
                </div>


                <?php include 'modal.view.php'; ?>

            </div>

        </div>

    </body>

    <script>
        <?php include 'scripts/modal.js'; ?>
    </script>

</html>