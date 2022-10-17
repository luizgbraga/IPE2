<div class='new-dados-form'>

    <h2 class='title'>Insira um novo dado</h2>

    <form id='dados' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>

        <div class='column'>
            <div class='row'>
                <div class='column'>
                    <label for='data'>Data</label>
                    <input type='date' name='data' class='data-input' value='<?php echo $data; ?>'>
                </div>
            </div>
            <span class='invalid-feedback'></span>
        </div>  

        <div class='row'>

            <div class='column'>
                <div class='row'>
                    <div class='column'>
                        <label for='consumo'>Consumo</label>
                        <input type='number' name='consumo' placeholder='kWh' class='left-modal-input'>
                    </div>
                    <div class='icon-modal'>
                        <img src='assets/plugue.png' alt='plugue-icon' width='22' height='22' />
                    </div>
                </div>
                <span class='invalid-feedback'></span>
            </div>   

            <div class='column'>
                <div class='row'>
                    <div class='column'>
                        <label for='demanda-medida'>Demanda medida</label>
                        <input type='number' name='demanda-medida' placeholder='kWh' class='right-modal-input'>
                    </div>
                    <div class='icon-modal'>
                        <img src='assets/medidor.png' alt='medidor-icon' width='22' height='22' />
                    </div>
                </div>
                <span class='invalid-feedback'></span>
            </div>  

        </div>

        <div class='row'>

            <div class='column'>
                <div class='row'>
                    <div class='column'>
                        <label for='energia-reativa'>Energia reativa</label>
                        <input type='number' name='energia-reativa' placeholder='kWh' class='left-modal-input'>
                    </div>
                    <div class='icon-modal'>
                        <img src='assets/energy.png' alt='user-icon' width='22' height='22' />
                    </div>
                </div>
                <span class='invalid-feedback'></span>
            </div>  

            <div class='column'>
                <div class='row'>
                    <div class='column'>
                        <label for='energia-ativa'>Energia ativa</label>
                        <input type='number' name='energia-ativa' placeholder='kWh' class='right-modal-input'>
                    </div>
                    <div class='icon-modal'>
                        <img src='assets/energy.png' alt='user-icon' width='22' height='22' />
                    </div>
                </div>
                <span class='invalid-feedback'></span>
            </div>  

        </div>

    </form>

    <div class='row'>
        <button type='button' id='submit-btn'>Salvar</button>
        <span class='close-modal'>Cancelar</span>
    </div>

</div>
