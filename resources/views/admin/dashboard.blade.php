<x-app-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSiswa }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKriteria }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-list fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sudah Dinilai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $persentaseDinilai }}%</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-clipboard-check fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Kriteria</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart" style="height: 245px;"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2 italic text-muted">
                            * Menampilkan pembagian bobot kriteria saat ini
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rata-rata Skor per Kriteria</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myDashboardChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data dari Controller
        const labelsArr = @json($kriteriaLabels);
        const dataArr = @json($kriteriaData);

        // Bar Chart
        const ctxBar = document.getElementById('myDashboardChart').getContext('2d');
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
        const ctxPie = document.getElementById('myPieChart').getContext('2d');
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
    </script>
</x-app-layout>