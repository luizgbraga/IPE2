let consumo = [];
let demandaMedida = [];
let secundary = {
  efetivo: Number(secundaryJSON[0]),
  metragem: Number(secundaryJSON[1]),
  demandaContratada: Number(secundaryJSON[2]),
  modalidade: secundaryJSON[3],
};

let limit = [];
let optimal = [];

for(let el of consumoJSON) {
  consumo.push(Number(el));
}

for(let el of demandaJSON) {
  demandaMedida.push(Number(el));
  limit.push(secundary.demandaContratada);
  optimal.push(optimalDemanda);
}

function year(data) {
  return data.substring(0, 4);
}

function betterLabels(data) {
  const months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
  index = Number(data.substring(5, 7));
  return months[index - 1] + '/' + year(data);
}

better = labels.map(betterLabels);

console.log(labels);

const dataConsumo = {
  labels: better,
  datasets: [{
    label: 'Consumo',
    backgroundColor: '#5D13E7',
    borderColor: '#5D13E7',
    data: consumo
  }]
};

const dataDemandaMedida = {
  labels: better,
  datasets: [{
    type: 'line',
    label: 'Demanda contratada',
    backgroundColor: '#151D3B',
    borderColor: '#151D3B',
    data: limit
  },

  {
    type: 'line',
    label: 'Demanda contratada',
    backgroundColor: '#4CBB17',
    borderColor: '#4CBB17',
    data: optimal
  },
  
  {
    type: 'bar',
    label: 'Demanda medida',
    backgroundColor: '#5D13E7',
    borderColor: '#5D13E7',
    data: demandaMedida,
  }]
};

const configConsumo = {
  type: 'line',
  data: dataConsumo,
  options: {
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false
      }
    }
  }
};

const configDemandaMedida = {
  type: 'bar',
  data: dataDemandaMedida,
  options: {
    maintainAspectRatio: false,

    elements: {
      point:{
          radius: 0
      }
    },

    plugins: {
      legend: {
        display: false
      }
    },
    
  }
};

const chartConsumo = new Chart(
  document.getElementById('chart-consumo'),
  configConsumo
);

const chartDemandaMedida = new Chart(
  document.getElementById('chart-demanda-medida'),
  configDemandaMedida
);