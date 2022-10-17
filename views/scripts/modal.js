// div que contém o conteúdo do modal
let modal = document.getElementById('modal');

// botão que abre o modal
let openBtn = document.getElementById('open-modal');

// elementos que são capazes de fechar o modal
let closeBtn = document.getElementsByClassName('close-modal')[0];

// botão que permite o submit no forms do modal
submitBtn = document.getElementById('submit-btn');

// ABRE o modal
openBtn.onclick = function() {
  modal.style.display = 'block';
}

// FECHA o modal caso clicado fora dele
window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
}

// FECHA o modal quando clicado em Cancelar e elimina as mensagens de erro
closeBtn.onclick = function() {
    modal.style.display = 'none';
    document.getElementsByClassName('invalid-feedback')[0].textContent = '';
    document.getElementsByClassName('invalid-feedback')[1].textContent = '';
    document.getElementsByClassName('invalid-feedback')[2].textContent = '';
    document.getElementsByClassName('invalid-feedback')[3].textContent = '';
    document.getElementsByClassName('invalid-feedback')[4].textContent = '';
}

// ENVIA o formulário caso esteja tudo preenchido; senão, não envia
submitBtn.onclick = function() {
  let data = document.forms['dados']['data'].value;
  let consumo = document.forms['dados']['consumo'].value;
  let demandaMedida = document.forms['dados']['demanda-medida'].value;
  let energiaAtiva = document.forms['dados']['energia-ativa'].value;
  let energiaReativa = document.forms['dados']['energia-reativa'].value;

  if(data === '') {
    document.getElementsByClassName('invalid-feedback')[0].textContent = 'Insira uma data';
  } if(data !== '') {
    document.getElementsByClassName('invalid-feedback')[0].textContent = '';
  } if(consumo === '') {
    document.getElementsByClassName('invalid-feedback')[1].textContent ='Insira um consumo';
  } if(consumo !== '') {
    document.getElementsByClassName('invalid-feedback')[1].textContent = '';
  } if(demandaMedida === '') {
    document.getElementsByClassName('invalid-feedback')[2].textContent ='Insira uma demanda';
  } if(demandaMedida !== '') {
    document.getElementsByClassName('invalid-feedback')[2].textContent = '';
  } if(energiaAtiva === '') {
    document.getElementsByClassName('invalid-feedback')[4].textContent ='Insira uma energia ativa';
  } if(energiaAtiva !== '') {
    document.getElementsByClassName('invalid-feedback')[4].textContent ='';
  } if(energiaReativa === '') {
    document.getElementsByClassName('invalid-feedback')[3].textContent ='Insira uma energia reativa';
  } if(energiaReativa !== '') {
    document.getElementsByClassName('invalid-feedback')[3].textContent = '';
  } if(data !== '' && demandaMedida !== '' && energiaAtiva !== '' && energiaReativa !== '') {
    document.getElementById('dados').submit();
  }
}
