<?php
include '../db/db.php';

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'weekly';

// Mengambil data untuk chart pie (jumlah hadir dan tidak hadir)
$pie_sql = "SELECT status, COUNT(*) as count FROM kegiatan GROUP BY status";
$pie_result = $conn->query($pie_sql);

$hadir = 0;
$tidakHadir = 0;

while ($row = $pie_result->fetch_assoc()) {
    if ($row['status'] == 'Hadir') {
        $hadir = $row['count'];
    } elseif ($row['status'] == 'Tidak Hadir') {
        $tidakHadir = $row['count'];
    }
}

if ($mode == 'weekly') {
    // Mengambil data untuk chart weekly (jumlah kegiatan per minggu)
    $weekly_sql = "
        SELECT 
            CONCAT(DATE_FORMAT(DATE_SUB(tanggal, INTERVAL WEEKDAY(tanggal) DAY), '%d/%m/%Y'), ' - ', 
                   DATE_FORMAT(DATE_ADD(DATE_SUB(tanggal, INTERVAL WEEKDAY(tanggal) DAY), INTERVAL 6 DAY), '%d/%m/%Y')) as week_range, 
            SUM(jumlahkegiatan) as jumlah 
        FROM kegiatan 
        GROUP BY YEAR(tanggal), WEEK(tanggal)
    ";
    $result = $conn->query($weekly_sql);

    $bar_data = [];
    while ($row = $result->fetch_assoc()) {
        $bar_data[] = [
            'day' => $row['week_range'],
            'present' => $row['jumlah']
        ];
    }
} else {
    // Mengambil data untuk chart monthly (jumlah kegiatan per bulan)
    $monthly_sql = "
        SELECT 
            DATE_FORMAT(tanggal, '%M %Y') as month, 
            SUM(jumlahkegiatan) as jumlah 
        FROM kegiatan 
        GROUP BY YEAR(tanggal), MONTH(tanggal)
    ";
    $result = $conn->query($monthly_sql);

    $bar_data = [];
    while ($row = $result->fetch_assoc()) {
        $bar_data[] = [
            'day' => $row['month'],
            'present' => $row['jumlah']
        ];
    }
}

// Menutup koneksi
$conn->close();

header('Content-Type: application/json');
echo json_encode([
    'pie' => ['hadir' => $hadir, 'tidakHadir' => $tidakHadir],
    'bar' => $bar_data
]);
