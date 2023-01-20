<div class='column center-content'>

    <h2 class='title'>Insira um novo dado</h2>

    <form id='dados' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>

        <div class='column'>
            <div class='row'>
                <div class='column'>
                    <label for='data'>Data</label>
                    <input type='month' name='data' class='data-input' value='<?php echo $data; ?>'>
                </div>
            </div>
            <span class='invalid-feedback'></span>
        </div>  

        <div class='row'>

            <div class='column'>
                <div class='row'>
                    <div class='column'>
                        <label for='consumo-p'>Consumo (ponta)</label>
                        <input type='number' name='consumo-p' placeholder='kWh' class='left-modal-input'>
                    </div>
                    <div class='icon-modal center-content'>
                        <img src='../assets/plugue.png' alt='plugue-icon' width='22' height='22' />
                    </div>
                </div>
                <span class='invalid-feedback'></span>
            </div>   


            <div class='column'>
                <div class='row'>
                    <div class='column'>
                        <label for='consumo-fp'>Consumo (fora de ponta)</label>
                        <input type='number' name='consumo-fp' placeholder='kWh' class='left-modal-input'>
                    </div>
                    <div class='icon-modal center-content'>
                        <img src='../assets/plugue.png' alt='plugue-icon' width='22' height='22' />
                    </div>
                </div>
                <span class='invalid-feedback'></span>
            </div>   

        </div>

        <?php if($modalidade == 'verde') { ?>

            
            <div class='column'>
                <div class='row'>
                    <div class='column'>
                        <label for='demanda-medida-p'>Demanda medida</label>
                        <input type='number' name='demanda-medida-p' placeholder='kWh' class='right-modal-input'>
                    </div>
                    <div class='icon-modal center-content'>
                        <img src='../assets/medidor.png' alt='medidor-icon' width='22' height='22' />
                    </div>
                </div>
                <span class='invalid-feedback'></span>
            </div>  

        <?php } else { ?>


            <div class='row'>

                <div class='column'>
                    <div class='row'>
                        <div class='column'>
                            <label for='demanda-medida-p'>Demanda medida (ponta)</label>
                            <input type='number' name='demanda-medida-p' placeholder='kWh' class='left-modal-input'>
                        </div>
                        <div class='icon-modal center-content'>
                            <img src='../assets/medidor.png' alt='user-icon' width='22' height='22' />
                        </div>
                    </div>
                    <span class='invalid-feedback'></span>
                </div>  

                <div class='column'>
                    <div class='row'>
                        <div class='column'>
                            <label for='demanda-medida-fp'>Demanda medida (fora)</label>
                            <input type='number' name='demanda-medida-fp' placeholder='kWh' class='right-modal-input'>
                        </div>
                        <div class='icon-modal center-content'>
                            <img src='../assets/medidor.png' alt='user-icon' width='22' height='22' />
                        </div>
                    </div>
                    <span class='invalid-feedback'></span>
                </div>  

            </div>

        <?php } ?>


        <div class='row'>

            <div class='column'>
                <div class='row'>
                    <div class='column'>
                        <label for='energia-reativa'>Energia reativa</label>
                        <input type='number' name='energia-reativa' placeholder='kWh' class='left-modal-input'>
                    </div>
                    <div class='icon-modal center-content'>
                        <img src='../assets/energy.png' alt='user-icon' width='22' height='22' />
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
                    <div class='icon-modal center-content'>
                        <img src='../assets/energy.png' alt='user-icon' width='22' height='22' />
                    </div>
                </div>
                <span class='invalid-feedback'></span>
            </div>  

        </div>

    </form>

    <div class='row'>
        <button type='button' id='submit-btn'>Salvar</button>
        <span class='close-modal center-content'>Cancelar</span>
    </div>

</div>
