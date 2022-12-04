<?php

$sec = Data::get_secundary(($_SESSION['id']));
$en = Data::get_energetic(($_SESSION['id']));
$sec_warnings = array_slice(array_map('value', $sec), 0, 2);
$en_warnings = (array_map('value', $en));
$profile_warnings = array_merge($sec_warnings, $en_warnings);

$counter = 0;
foreach($profile_warnings as $el) {
    if($el == 'Não há') {
        $counter++;
    }
}
if($counter === 0) {
    $warning = false;
} else {
    $warning = true;
}

?>


<nav>

    <div class="actions-nav column">

    <?php if($_SESSION['master'] === 1) { ?>

        <div>

            <div class="nav-item row <?php if($home_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/home.png' width="20" height="20">
                <a href='welcome.php'>
                    <p class="action-nav-text">Início</p>
                </a>
            </div>

            <div class='nav-item row'>
                <img class='icon-nav' src='assets/add-input.png' width="20" height="20">
                <a href='#' id='open-modal'>
                    <p class="action-nav-text">Novo Input</p>
                </a>
            </div>

            <div class="nav-item row <?php if($gerenciar_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/manage.png' width="20" height="20">
                <a href='gerenciar.php'>
                    <p class="action-nav-text">Gerenciar Inputs</p>
                </a>
            </div>

            <div class="nav-item row <?php if($mensagens_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/chat.png' width="20" height="20">
                <a href='mensagens.php'>
                    <p class="action-nav-text">Mensagens</p>
                </a>
            </div>

            <?php if($sec['possui_subordinados'] === 1) { ?>
                <div class="nav-item row <?php if($adicionar_subordinado_nav === true) {
                echo 'colored-nav-item';
                } ?>">
                    <img class='icon-nav' src='assets/add-user.png' width="20" height="20">
                    <a href='addsubordinados.php'>
                        <p class="action-nav-text">Adicionar subordinado</p>
                    </a>
                </div>

            <div class="nav-item row <?php if($subordinados_nav === true) {
                echo 'colored-nav-item';
                } ?>">
                    <img class='icon-nav' src='assets/hierarchy.png' width="20" height="20">
                    <a href='subordinados.php?subordinados=0'>
                        <p class="action-nav-text">Subordinados</p>
                    </a>
                </div>
            <?php } ?>

            <!---

            <div class="nav-item row <?php if($compare_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/compare.png' width="20" height="20">
                <a href='compare.php'>
                    <p class="action-nav-text">Comparação</p>
                </a>
            </div>
            -->

            <div class="nav-item row <?php if($profile_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/user.png' width="20" height="20">
                <a href='profile.php'>
                    <p class="action-nav-text">Perfil</p>
                </a>
                <?php if($warning) {
                    echo "<img class='warning-nav' src='assets/warning.png' width='20' height='20'>";
                } ?>
            </div>

        </div>

        <div class='nav-item row'>
            <img class='icon-nav' src='assets/setting.png' width="20" height="20">
            <a href=''>
                <p class="action-nav-text">Configurações</p>
            </a>
        </div>

    </div>

    <? } else { ?>

        <div>

            <div class="nav-item row <?php if($home_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/home.png' width="20" height="20">
                <a href='welcome.php'>
                    <p class="action-nav-text">Início</p>
                </a>
            </div>

            <div class='nav-item row'>
                <img class='icon-nav' src='assets/add-input.png' width="20" height="20">
                <a href='#' id='open-modal'>
                    <p class="action-nav-text">Novo Input</p>
                </a>
            </div>

            <div class="nav-item row <?php if($gerenciar_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/manage.png' width="20" height="20">
                <a href='gerenciar.php'>
                    <p class="action-nav-text">Gerenciar Inputs</p>
                </a>
            </div>


            <!---

            <div class="nav-item row <?php if($compare_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/compare.png' width="20" height="20">
                <a href='compare.php'>
                    <p class="action-nav-text">Comparação</p>
                </a>
            </div>
            -->

            <div class="nav-item row <?php if($profile_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/user.png' width="20" height="20">
                <a href='profile.php'>
                    <p class="action-nav-text">Perfil</p>
                </a>
                <?php if($warning) {
                    echo "<img class='warning-nav' src='assets/warning.png' width='20' height='20'>";
                } ?>
            </div>

        </div>

        <div class='nav-item row'>
            <img class='icon-nav' src='assets/setting.png' width="20" height="20">
            <a href=''>
                <p class="action-nav-text">Configurações</p>
            </a>
        </div>

    </div>

    <?php } ?>

</nav>