let dataNumber = [];

for(let el of dataJSON) {
  dataNumber.push(Number(el));
}

const data = {
  labels: labels,
  datasets: [{
    label: 'Consumo',
    backgroundColor: '#5D13E7',
    borderColor: '#5D13E7',
    data: dataNumber
  }]
};

const config = {
  type: 'line',
  data: data,
  options: {}
};

const myChart = new Chart(
  document.getElementById('myChart'),
  config
);