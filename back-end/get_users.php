<?php
require_once 'connection.php';

// Fetch.
$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    http_response_code(200);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // echo json_encode($users);
} else {
    http_response_code(422);
    echo "Error in getting users details";
}
?>