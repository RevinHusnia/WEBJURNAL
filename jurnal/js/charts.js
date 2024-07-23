document.addEventListener('DOMContentLoaded', function() {
    let pieChartInstance;
    let barChartInstance;

    const fetchData = (mode = 'weekly') => {
        fetch(`/data/data.php?mode=${mode}`)
            .then(response => response.json())
            .then(data => {
                // Pie Chart
                const ctxPie = document.getElementById('pieChart').getContext('2d');
                if (pieChartInstance) {
                    pieChartInstance.destroy();
                }
                pieChartInstance = new Chart(ctxPie, {
                    type: 'pie',
                    data: {
                        labels: ['Hadir', 'Tidak Hadir'],
                        datasets: [{
                            data: [data.pie.hadir, data.pie.tidakHadir],
                            backgroundColor: ['#800080', '#E4003A']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                // Bar Chart
                const ctxBar = document.getElementById('barChart').getContext('2d');
                if (barChartInstance) {
                    barChartInstance.destroy();
                }
                barChartInstance = new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: data.bar.map(row => row.day),
                        datasets: [{
                            label: 'Jumlah Kegiatan',
                            data: data.bar.map(row => row.present),
                            backgroundColor: ['#E9FF97', '#FFD18E', '#FFA38F', '#FF7EE2', '#36a2eb']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    };

    // Event listener for dropdown
    document.getElementById('chartMode').addEventListener('change', (event) => {
        fetchData(event.target.value);
    });

    // Fetch initial data for Weekly view
    fetchData('weekly');
});
