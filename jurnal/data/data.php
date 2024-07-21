<?php
include '../db/db.php';

function fetchData($conn) {
    $sql = "SELECT day, present, not_present FROM daily_attendance";
    $result = $conn->query($sql);

    
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}



$data = fetchData($conn);
echo json_encode($data);


