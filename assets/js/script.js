// function boutton index
// const body = document.body;
// const btn = document.querySelectorAll('.button')[0];

// btn.addEventListener('mouseenter', () => {
// 	body.classList.add('show');
// });

// btn.addEventListener('mouseleave', () => {
// 	body.classList.remove('show');
// });
// fin function boutton 






// chart js
let ctx = document.getElementById('myChart').getContext('2d');
let labels = ['Depenses', 'Revenus'];
let colorHex = ['#000000', '#FFFF00'];

let myChart = new Chart(ctx, {
  type: 'pie',
  data: {	
    datasets: [{
      data: [30, 10],
      backgroundColor: colorHex
    }],
    labels: labels
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom'
    },
    plugins: {
      datalabels: {
        color: '#fff',
        anchor: 'end',
        align: 'start',
        offset: -10,
        borderWidth: 2,
        borderColor: '#fff',
        borderRadius: 25,
        backgroundColor: (context) => {
          return context.dataset.backgroundColor;
        },
        font: {
          weight: 'bold',
          size: '10'
        },
        formatter: (value) => {
          return value + ' %';
        }
      }
    }
  }
})
// char js fin