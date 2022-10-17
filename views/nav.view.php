<nav>

    <div class="actions-nav">

        <div>

            <div class="item-nav <?php if($home_nav === true) {
                echo 'nav-item';
            } ?>">
                <img class='icon-nav' src='assets/home.png' width="20" height="20">
                <a href='welcome.php'>
                    <p class="action-nav">Início</p>
                </a>
            </div>

            <div class='item-nav'>
                <img class='icon-nav' src='assets/add-input.png' width="20" height="20">
                <a href='#' id='open-modal'>
                    <p class="action-nav">Novo Input</p>
                </a>
            </div>

            <div class="item-nav <?php if($mensagens_nav === true) {
                echo 'nav-item';
            } ?>">
                <img class='icon-nav' src='assets/chat.png' width="20" height="20">
                <a href='mensagens.php'>
                    <p class="action-nav">Mensagens</p>
                </a>
            </div>

            <div class="item-nav <?php if($adicionar_subordinado_nav === true) {
                echo 'nav-item';
            } ?>">
                <img class='icon-nav' src='assets/add-user.png' width="20" height="20">
                <a href='acesslevel.php'>
                    <p class="action-nav">Adicionar subordinado</p>
                </a>
            </div>

            <div class="item-nav <?php if($subordinados_nav === true) {
                echo 'nav-item';
            } ?>">
                <img class='icon-nav' src='assets/hierarchy.png' width="20" height="20">
                <a href=''>
                    <p class="action-nav">Subordinados</p>
                </a>
            </div>

            <div class="item-nav <?php if($profile_nav === true) {
                echo 'nav-item';
            } ?>">
                <img class='icon-nav' src='assets/user.png' width="20" height="20">
                <a href='profile.php'>
                    <p class="action-nav">Perfil</p>
                </a>
            </div>

        </div>

        <div class='item-nav settings'>
            <img class='icon-nav' src='assets/setting.png' width="20" height="20">
            <a href=''>
                <p class="action-nav">Configurações</p>
            </a>
        </div>

    </div>

</nav>