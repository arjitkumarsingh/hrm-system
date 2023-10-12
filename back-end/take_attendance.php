<?php
session_start();
require_once 'connection.php';
print_r($_POST);
if (isset($_POST['login_time'])) {
    // Store.
    $sql = "INSERT INTO `employee_attendance`(`date`, `login_time`, `user_id`) VALUES
    ('$_POST[date]', STR_TO_DATE('$_POST[login_time]', '%T'), $_SESSION[id])";

    if (mysqli_query($conn, $sql)) {
        http_response_code(201);
        $_SESSION['login'] = true;
        echo "<script type='text/javascript'>window.location.href = '../front-end/user-dashboard.php'</script>";
    } else {
        http_response_code(422);
        echo "Error in taking attendance";
        echo "<script type='text/javascript'>window.location.href = '../front-end/user-dashboard.php'</script>";
    }
} elseif (isset($_POST['logout_time'])) {

    $sql = "SELECT MAX(id) AS last_id FROM employee_attendance WHERE user_id = '$_SESSION[id]'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $last_id = mysqli_fetch_assoc($result)['last_id'];

        $sql = "UPDATE employee_attendance SET `logout_time` = STR_TO_DATE('$_POST[logout_time]', '%T') WHERE `id` =  $last_id";

        if (mysqli_query($conn, $sql)) {
            http_response_code(200);
            unset($_SESSION['login']);
            echo "<script type='text/javascript'>window.location.href = '../front-end/user-dashboard.php'</script>";
        } else {
            http_response_code(422);
            echo "Error in updating attendance";
            echo "<script type='text/javascript'>window.location.href = '../front-end/user-dashboard.php'</script>";
        }
    } else {
        echo "Error in getting last id";
    }
}
