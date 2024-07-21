document.addEventListener('DOMContentLoaded', function() {
    fetch('/data/data.php')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(row => row.day);
            const present = data.map(row => row.present);
            const notPresent = data.map(row => row.not_present);

            // Pie Chart
            const ctxPie = document.getElementById('pieChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Hadir', 'Tidak Hadir'],
                    datasets: [{
                        data: [present.reduce((a, b) => a + b, 0), notPresent.reduce((a, b) => a + b, 0)],
                        backgroundColor: ['#7B1FA2', '#D1C4E9']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Bar Chart
            const ctxBar = document.getElementById('barChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Kegiatan',
                        data: present,
                        backgroundColor: ['#2196F3', '#FF9800', '#9C27B0', '#673AB7', '#8BC34A']
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
});