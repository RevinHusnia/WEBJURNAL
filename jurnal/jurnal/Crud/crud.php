<?php
include '../db/db.php';

function fetchData($conn) {
    $sql = "SELECT day, present, not_present FROM daily_attendance";
    $result = $conn->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

// Insert Data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'insert') {
    $day = $_POST['day'];
    $present = $_POST['present'];
    $not_present = $_POST['not_present'];
    $sql = "INSERT INTO daily_attendance (day, present, not_present) VALUES ('$day', $present, $not_present)";
    $conn->query($sql);
}

// Update Data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $day = $_POST['day'];
    $present = $_POST['present'];
    $not_present = $_POST['not_present'];
    $sql = "UPDATE daily_attendance SET day='$day', present=$present, not_present=$not_present WHERE id=$id";
    $conn->query($sql);
}

// Delete Data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM daily_attendance WHERE id=$id";
    $conn->query($sql);
}


