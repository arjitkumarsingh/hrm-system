<?php
session_start();
require_once 'connection.php';

echo "<pre>";
print_r($_POST);
print_r($_SESSION);
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["from"])) {
        $_SESSION['fromErr'] = "From date is required";
        echo "From date is required";
    } else {
        $from = test_input($_POST["from"]);
        if (strtotime($_POST['from']) < strtotime(date("Y-m-d"))) {
            $_SESSION['fromErr'] = "Past date is not allowed";
            echo "Past date is not allowed";
        }
    }

    if (empty($_POST["to"])) {
        $_SESSION['toErr'] = "To date is required";
        echo "To date is required";
    } else {
        $to = test_input($_POST["to"]);
        if (strtotime($_POST['to']) < strtotime($_POST['from'])) {
            $_SESSION['toErr'] = "To date must be ahead of from date";
            echo "To date must be ahead of from date";
        }
    }

    if (empty($_POST["days"])) {
        $_SESSION['daysErr'] = "Number of days is required";
        echo "Number of days is required";
    } else {
        $days = test_input($_POST["days"]);
        if ($days < 1) {
            $_SESSION['daysErr'] = "Number of days must be at least 1 day";
            echo "Number of days must be at least 1 day";
        }
    }

    if (empty($_POST["reason"])) {
        $_SESSION['reasonErr'] = "Reason is required";
        echo "Reason is required";
    } else {
        // $reason = strip_tags($_POST["reason"]);
        // $reason = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $_POST["reason"]);
        // $reason = test_input($_POST["reason"]);
        $reason = $_POST["reason"];
        // if (!preg_match("/^[a-zA-Z-':() ]*$/", $reason)) {
        //     $_SESSION['reasonErr'] = "Only _ - ' : ( ) special characters are allowed";
        //     echo "line : 54 Only _ - ' : ( ) spacial characters are allowed";
        // }
        if (strlen($reason) < 20) {
            $_SESSION['reasonErr'] = "Reason is too short";
            echo "Reason is too short";
        }
    }

    if (empty($_SESSION['fromErr']) && empty($_SESSION['toErr']) && empty($_SESSION['daysErr']) && empty($_SESSION['reasonErr'])) {

        $sql = "INSERT INTO `leaves` (`from_date`, `to_date`, `days`, `reason`, `user_id`) VALUES ('$from', '$to', '$days', '$reason', '$_SESSION[id]')";
        if (mysqli_query($conn, $sql)) {
            http_response_code(201);
            echo "<script type='text/javascript'>window.location.href = '../front-end/user-dashboard.php'</script>";
        } else {
            http_response_code(422);
            echo "Error in applying for leave";
            echo "<script type='text/javascript'>window.location.href = '../front-end/leave.php'</script>";
        }
    } else {
        echo "Can not apply for leave without valid inputs";
        http_response_code(422);
        // echo "<script type='text/javascript'>window.location.href = '../front-end/leave.php'</script>";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    echo "<br>";
    echo $data;
    echo "\t";
    echo strlen($data);
    return $data;
}
?>