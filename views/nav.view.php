<nav>

    <div class="actions-nav column">

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

            <div class="nav-item row <?php if($mensagens_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/chat.png' width="20" height="20">
                <a href='mensagens.php'>
                    <p class="action-nav-text">Mensagens</p>
                </a>
            </div>

            <div class="nav-item row <?php if($adicionar_subordinado_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/add-user.png' width="20" height="20">
                <a href='acesslevel.php'>
                    <p class="action-nav-text">Adicionar subordinado</p>
                </a>
            </div>

            <div class="nav-item row <?php if($subordinados_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/hierarchy.png' width="20" height="20">
                <a href='subordinados.php'>
                    <p class="action-nav-text">Subordinados</p>
                </a>
            </div>

            <div class="nav-item row <?php if($profile_nav === true) {
                echo 'colored-nav-item';
            } ?>">
                <img class='icon-nav' src='assets/user.png' width="20" height="20">
                <a href='profile.php'>
                    <p class="action-nav-text">Perfil</p>
                </a>
            </div>

        </div>

        <div class='nav-item row'>
            <img class='icon-nav' src='assets/setting.png' width="20" height="20">
            <a href=''>
                <p class="action-nav-text">Configurações</p>
            </a>
        </div>

    </div>

</nav>