/**
 * Created by igor.muller on 12/06/2017.
 */
console.log(sale_price);
var report_month = new Chart (document.getElementById("report_month"), {
    type: "line",
    data: {
        labels: days_list,
        datasets: [{
            label: "Receita",
            data: sale_price,
            backgroundColor: ['#26871C'],
            borderColor: ['#26871C'],
            fill: false,
            borderWidth: 2
        },
        {
            label: "Despesa",
            data: purchase_price,
            backgroundColor: ['#A41E18'],
            borderColor: ['#A41E18'],
            fill: false,
            borderWidth: 2
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        tooltips: {
            mode: 'nearest',
            intersect: false,
            displayColors: false
        }
    }
});

var report_status = new Chart(document.getElementById("report_status"), {
    type: "doughnut",
    data: {
        labels: [
            "Cancelado",
            "Aguardando Pgto",
            "Pago"
        ],
        datasets: [{
            data: [10,20,30],
            backgroundColor: [
                '#BE2F16',
                '#BE9F3D',
                '#65BE57'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        tooltips: {
            mode: 'nearest',
            intersect: false,
            displayColors: false
        }
    }
});