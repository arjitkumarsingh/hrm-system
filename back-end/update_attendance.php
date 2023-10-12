<?php
require_once "connection.php";
if (isset($_POST['login_time'])) {
    $sql = "UPDATE employee_attendance SET `logout_time` = '$_POST[logout_time]' WHERE `date` = $_POST[date]";

    if (mysqli_query($conn, $sql)) {
        http_response_code(200);
        // echo "User updated";
        // $_SESSION['msg'] = "User details updated successfully";
    } else {
        http_response_code(422);
        // echo "Error in updating user details";
        // $_SESSION['error'] = "Error in updating user details";
    }
}
?>