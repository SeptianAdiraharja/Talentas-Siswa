// public/js/dashboard-charts.js

document.addEventListener('DOMContentLoaded', function () {
    // Ambil data dari elemen HTML (didefinisikan di Blade)
    const chartElement = document.getElementById('myDashboardChart');
    if (!chartElement) return;

    const labelsArr = JSON.parse(chartElement.dataset.labels);
    const dataArr = JSON.parse(chartElement.dataset.values);

    // Bar Chart
    const ctxBar = chartElement.getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labelsArr,
            datasets: [{
                label: 'Rata-rata Nilai',
                data: dataArr,
                backgroundColor: '#4e73df',
                hoverBackgroundColor: '#2e59d9',
                borderColor: '#4e73df',
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{ ticks: { beginAtZero: true } }]
            }
        }
    });

    // Pie Chart
    const pieElement = document.getElementById('myPieChart');
    if (pieElement) {
        const ctxPie = pieElement.getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: labelsArr,
                datasets: [{
                    data: dataArr,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617', '#5a5c69'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: { display: false },
                cutoutPercentage: 70,
            },
        });
    }
});