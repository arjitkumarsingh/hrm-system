<?php
require_once 'connection.php';

// Fetch.
if (isset($_GET['id'])) {
    $sql = "SELECT `id`, DATE_FORMAT(`from_date`, '%d-%m-%Y') AS `from_date`, DATE_FORMAT(`to_date`, '%d-%m-%Y') AS `to_date`, `days`, `reason`, `user_id`
            FROM `leaves` WHERE user_id = $_GET[id]";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        http_response_code(200);
        $leaves = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // header("location: ../front-end/user-leaves.php");
    } else {
        http_response_code(422);
        // echo "Error in getting leaves";
        // header("location: ../front-end/admin-dashboard.php");
    }
}
?>