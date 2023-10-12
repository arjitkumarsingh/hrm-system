<?php
session_start();
require_once 'connection.php';

// Fetch.
$sql = "SELECT id, DATE_FORMAT(date, '%d-%m-%Y') AS date, DATE_FORMAT(login_time, '%r') AS login_time, DATE_FORMAT(logout_time, '%r') AS logout_time, user_id,
        TIMEDIFF(logout_time, login_time) AS work_hours FROM `employee_attendance` WHERE `user_id` = $_SESSION[id]";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    http_response_code(200);
    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // echo json_encode($records);
    // echo $records;
} else {
    http_response_code(422);
    // echo "Error in getting users details";
}
?>