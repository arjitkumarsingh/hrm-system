<?php
require_once 'connection.php';

// Fetch.
if (isset($user['role'])) {
    $sql = "SELECT * FROM `roles` WHERE ID = $user[role]";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        http_response_code(200);
        $role = mysqli_fetch_assoc($result);
        // print_r($roles);
        // echo json_encode($users);
    } else {
        http_response_code(422);
        echo "Error in getting roles";
    }
}

$sql = "SELECT * FROM `roles`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    http_response_code(200);
    $roles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($roles);
    // echo json_encode($users);
} else {
    http_response_code(422);
    echo "Error in getting roles";
}
?>