<?php
require_once "connection.php";

$sql = "DELETE FROM users WHERE id = $_GET[id]";

if (mysqli_query($conn, $sql)) {
    http_response_code(200);
    echo "User deleted";
    header("Location: ../front-end/admin-dashboard.php");

} else {
    http_response_code(422);
    echo "Error in deleting user";
}
?>