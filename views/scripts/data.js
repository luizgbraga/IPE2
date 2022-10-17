let consumo = [];
let demandaMedida = [];

for(let el of consumoJSON) {
  consumo.push(Number(el));
}

for(let el of demandaJSON) {
  demandaMedida.push(Number(el));
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
    label: 'Consumo',
    backgroundColor: '#5D13E7',
    borderColor: '#5D13E7',
    data: demandaMedida
  }]
};

const configConsumo = {
  type: 'line',
  data: dataConsumo,
  options: {
    plugins: {
      legend: {
        display: false
      }
    }
  }
};

const configDemandaMedida = {
  type: 'line',
  data: dataDemandaMedida,
  options: {
    plugins: {
      legend: {
        display: false
      }
    }
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