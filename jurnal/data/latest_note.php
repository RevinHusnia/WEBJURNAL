<?php
include '../db/db.php';

$note_sql = "SELECT DATE_FORMAT(tanggal, '%W, %d %M %Y') as formatted_date, catatan FROM catatan ORDER BY tanggal DESC LIMIT 1";
$note_result = $conn->query($note_sql);

if ($note_result->num_rows > 0) {
    $latest_note = $note_result->fetch_assoc();
} else {
    $latest_note = ['formatted_date' => 'No data', 'catatan' => 'No data'];
}

$conn->close();