<?php
include '../partials/header.php';
include '../db/db.php';

$sql = "SELECT status, COUNT(*) as count FROM kegiatan GROUP BY status";
$result = $conn->query($sql);

$totalHadir = 0;
$totalTidakHadir = 0;

while ($row = $result->fetch_assoc()) {
    if ($row['status'] == 'Hadir') {
        $totalHadir = $row['count'];
    } elseif ($row['status'] == 'Tidak Hadir') {
        $totalTidakHadir = $row['count'];
    }
}

include '../data/latest_activity.php';
include '../data/latest_note.php';
?>

<h1>Home</h1>
<div class="cards">
    <div class="card">
        <img src="/assets/immigration.png"></img>
        <div class="content" id="totalHadir">
        <h2 class="h2">Hadir: <?php echo $totalHadir; ?></h2>
        <h2 class="h2">Tidak Hadir: <?php echo $totalTidakHadir; ?></h2>
        </div>
    </div>
    <div class="card">
    <img src="/assets/working.png"></img>
        <div class="content" id="kegiatan">
        <h2 class="title">Kegiatan Terbaru</h2>
            <p class="content">Tanggal: <?php echo $latest_activity['formatted_date']; ?></p>
            <p class="content">Kegiatan: <?php echo $latest_activity['kegiatan']; ?></p>
        </div>
    </div>
    <div class="card">
    <img src="/assets/notepad.png"></img>
        <div class="content" id="catatan">
        <h2 class="title">Catatan Instruktur Terbaru</h2>
            <p class="content">Tanggal: <?php echo $latest_note['formatted_date']; ?></p>
            <p class="content">Catatan: <?php echo $latest_note['catatan']; ?></p>
        </div>
    </div>
</div>
<div class="content-area">
    <div class="chart-container">
        <h2>Total Hadir</h2>
        <canvas id="pieChart"></canvas>
    </div>
    <div class="chart-container">
        <h2>Jumlah Kegiatan</h2>
        <canvas id="barChart"></canvas>
    </div>
</div>

<?php include '../partials/footer.php'; ?>