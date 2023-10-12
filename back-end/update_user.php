<?php
session_start();
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $_SESSION['nameErr'] = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $_SESSION['nameErr'] = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $_SESSION['emailErr'] = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['emailErr'] = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $_SESSION['passwordErr'] = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        if (!preg_match("/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $password)) {
            $_SESSION['passwordErr'] = "Password must be a combination of symbol(!@#$%^&*), number, upper & lower case letter and minimum 8 characters long";
        }
    }

    if (empty($_POST["phone"])) {
        $phone = "";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phone))
            $_SESSION['phoneErr'] = "Phone number must be 10 digits long";
    }

    if (empty($_POST["salary"])) {
        $salary = "";
    } else {
        $salary = test_input($_POST["salary"]);
    }

    if (empty($_POST["role"])) {
        $role = 2;
    } else {
        $role = $_POST["role"];
    }

    if (empty($_SESSION['nameErr']) && empty($_SESSION['emailErr']) && empty($_SESSION['passwordErr']) && empty($_SESSION['phoneErr'])) {
        if (empty($_FILES["image"]["name"])) {
            $uploadOk = 1;
            $sql = "UPDATE `users` SET `name` = '$_POST[name]', `email` = '$_POST[email]', `password` = '$_POST[password]', `phone_number` = '$_POST[phone]',
                    `salary` = '$_POST[salary]', `role` = '$_POST[role]' WHERE `id` = $_POST[id]";
        } else {
            include "save_image.php";
            $image = $file_name;
            $sql = "UPDATE `users` SET `image` = '$image', `name` = '$_POST[name]', `email` = '$_POST[email]', `password` = '$_POST[password]', `phone_number` = '$_POST[phone]',
                    `salary` = '$_POST[salary]', `role` = '$_POST[role]' WHERE `id` = $_POST[id]";
        }

        if ($uploadOk == 1) {
            if (mysqli_query($conn, $sql)) {
                http_response_code(201);
                echo "<script type='text/javascript'>window.location.href = '../front-end/admin-dashboard.php'</script>";
            } else {
                http_response_code(422);
                echo "<script type='text/javascript'>window.location.href = '../front-end/update.php?id=$_POST[id]'</script>";
            }
        } else {
            http_response_code(422);
            echo "<script type='text/javascript'>window.location.href = '../front-end/update.php?id=$_POST[id]'</script>";
            print_r($_SESSION);
        }
    } else {
        http_response_code(422);
        echo "<script type='text/javascript'>window.location.href = '../front-end/update.php?id=$_POST[id]'</script>";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>