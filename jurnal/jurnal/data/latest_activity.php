<?php
include '../db/db.php';

$activity_sql = "SELECT nama, DATE_FORMAT(tanggal, '%W, %d %M %Y') as formatted_date, kegiatan FROM kegiatan ORDER BY tanggal DESC LIMIT 1";
$activity_result = $conn->query($activity_sql);
$latest_activity = $activity_result->fetch_assoc();

$conn->close();
