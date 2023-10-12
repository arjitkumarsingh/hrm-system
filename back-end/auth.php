<?php
session_start();
require_once 'connection.php';

if (isset($_POST['email']) && isset($_POST['password'])) {

    // Fetch for login
    $sql = "SELECT `id`, `name`, `email`, `password`, `salary`, `role` FROM `users` WHERE `email` = '$_POST[email]' AND `password` = '$_POST[password]'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        http_response_code(200);
        $user = (mysqli_fetch_assoc($result));
        print_r($user);
        $_SESSION['id'] = $user['id'];
        $_SESSION['salary'] = $user['salary'];
        unset($_SESSION['error']);
        // unset($_SESSION['msg']);
        if ($user['role'] == 1) {
            header("location: ../front-end/admin-dashboard.php");
        } else {
            header("location: ../front-end/user-dashboard.php");
        }
    } else {
        http_response_code(422);
        $_SESSION['error'] = "User not found: Check Credentials";
        header("location: ../front-end/login.php");
    }
}
?>