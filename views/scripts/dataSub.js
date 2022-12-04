let consumoPonta = [];
let consumoForaPonta = [];
let demandaMedida = [];

let limit = [];


for(let el of consumoPJSON) {
  consumoPonta.push(Number(el));
}

for(let el of consumoFPJSON) {
  consumoForaPonta.push(Number(el));
}

for(let i in demandaJSON) {
    demandaMedida.push(Number(demandaJSON[i]));
    if(i > 4 && i < 10) {
      limit.push(demandaContratadaS);
    } else {
      limit.push(demandaContratadaU);
    }
}

console.log(consumoPonta);

function year(data) {
  return data.substring(2, 4);
}

function betterLabels(data) {
  const months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
  index = Number(data.substring(5, 7));
  return months[index - 1] + '/' + year(data);
}

better = labels.map(betterLabels);


const dataConsumo = {
  labels: better,
  datasets: [{
    label: 'Ponta',
    backgroundColor: '#115F9A',
    borderColor: '#115F9A',
    data: consumoPonta
  },

  {
    label: 'Fora',
    backgroundColor: '#6b506b',
    borderColor: '#6b506b',
    data: consumoForaPonta
  }]
};

const dataDemandaMedida = {
  labels: better,
  datasets: [{
    type: 'line',
    label: 'Contratada',
    backgroundColor: '#b30000',
    borderColor: '#b30000',
    data: limit,
  },
  
  {
    type: 'line',
    label: 'Medida',
    backgroundColor: 'rgba(17, 95, 154, 0.4)',
    borderColor: '#115F9A',
    data: demandaMedida,
    fill: 'start'
  }]
};

const configConsumo = {
  type: 'line',
  data: dataConsumo,
  options: {
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: true,
        position: 'right',
      }
    },
    reponsive: true,
    scales: {
      y: {
        title: {
          display: true,
          text: 'Consumo em kWh'
        },
        ticks: {
          stepSize: 100
        },
        min: 0,

      }
    }
  }
};

const configDemandaMedida = {
  type: 'line',
  data: dataDemandaMedida,
  options: {
    maintainAspectRatio: false,

    reponsive: true,
    scales: {
      y: {
        title: {
          display: true,
          text: 'Demanda em kW'
        },
        ticks: {
          stepSize: 500
        },
        min: 0,
      },

      x: {
        min: 0
      }
    },

    elements: {
      point:{
          radius: 0
      }
    },

    plugins: {
      legend: {
        display: true,
        position: 'right',
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