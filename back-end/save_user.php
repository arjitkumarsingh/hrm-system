<?php
session_start();
require_once 'connection.php';

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
            $image = "";
            $uploadOk = 1;
        } else {
            include "save_image.php";
            $image = $file_name;
        }

        $sql = "INSERT INTO `users` (`image`, `name`,`email`, `password`, `phone_number`, `salary`, `role`) VALUES ('$image', '$name', '$email',
                '$_POST[password]', '$phone', '$salary', '$role')";
        if ($uploadOk == 1) {
            if (mysqli_query($conn, $sql)) {
                http_response_code(201);
                if (!empty($_SESSION['id'])) {
                    echo "<script type='text/javascript'>window.location.href = '../front-end/admin-dashboard.php'</script>";
                } else {
                    echo "<script type='text/javascript'>window.location.href = '../front-end/login.php'</script>";
                }
            } else {
                http_response_code(422);
                $_SESSION['error'] = "Error in registering user";
                if (!empty($_SESSION['id'])) {
                    echo "<script type='text/javascript'>window.location.href = '../front-end/admin-dashboard.php'</script>";
                } else {
                    echo "<script type='text/javascript'>window.location.href = '../front-end/register.php'</script>";
                }
            }
        } else {
            echo "upload failed";
            http_response_code(422);
            if (isset($_SESSION['id'])) {
                // echo json_encode($_SESSION);
                echo "<script type='text/javascript'>window.location.href = '../front-end/new-user.php'</script>";
            } else {
                // echo "register";
                echo "<script type='text/javascript'>window.location.href = '../front-end/register.php'</script>";
            }
        }
    } else {
        http_response_code(422);
        if (isset($_SESSION['id'])) {
            // echo json_encode($_SESSION);
            echo "<script type='text/javascript'>window.location.href = '../front-end/new-user.php'</script>";
        } else {
            // echo "register";
            echo "<script type='text/javascript'>window.location.href = '../front-end/register.php'</script>";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>