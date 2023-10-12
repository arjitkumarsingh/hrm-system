<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="crud.js"></script>
</head>

<body>
    <?php
    session_start();
    ?>

    <form action="../back-end/save_user.php" method="POST" class="text-center m-5 p-5" id="registration-form">
        <h1>Register Here</h1>
        <br>
        <div class="input-group mb-3">
            <span class="input-group-text">Name: </span>
            <input class="form-control" id="name" type="text" name="name" placeholder="Full Name" aria-label="full name">
        </div>
        <?php
        if (isset($_SESSION['nameErr'])) {
        ?>
            <div class="mb-3 text-danger">
                <?php
                echo $_SESSION['nameErr'];
                unset($_SESSION['nameErr']);
                ?>
            </div>
        <?php
        } else {
        ?>
            <div class="mb-3 text-danger" id="nameErr"><br></div>
        <?php
        }
        ?>

        <div class="input-group mb-3">
            <span class="input-group-text">Email: </span>
            <input class="form-control" id="email" type="email" name="email" placeholder="xyz@example.com" aria-label="email id">
        </div>
        <?php
        if (isset($_SESSION['emailErr'])) {
        ?>
            <div class="mb-3 text-danger">
                <?php
                echo $_SESSION['emailErr'];
                unset($_SESSION['emailErr']);
                ?>
            </div>
        <?php
        } else {
        ?>
            <div class="mb-3 text-danger" id="emailErr"><br></div>
        <?php
        }
        ?>

        <div class="input-group mb-3">
            <span class="input-group-text">Password: </span>
            <input class="form-control" id="password" type="password" name="password" placeholder="Password" aria-label="password">
            <span id="toggle-password" class="fs-5 badge"><a href="javascript:void(0)" class="text-reset"><i id="eye" class="bi bi-eye"></i></a></span>
        </div>
        <?php
        if (isset($_SESSION['passwordErr'])) {
        ?>
            <div class="mb-3 text-danger">
                <?php
                echo $_SESSION['passwordErr'];
                unset($_SESSION['passwordErr']);
                ?>
            </div>
        <?php
        } else {
        ?>
            <div class="mb-3 text-danger" id="passwordErr"><br></div>
        <?php
        }
        ?>

        <div class="input-group mb-3">
            <span class="input-group-text">Phone: </span>
            <input class="form-control" id="phone" type="number" name="phone" placeholder="10 digit mobile number" aria-label="mobile number">
        </div>
        <?php
        if (isset($_SESSION['phoneErr']) && !empty($_SESSION['phoneErr'])) {
        ?>
            <div class="mb-3 text-danger">
                <?php
                echo $_SESSION['phoneErr'];
                unset($_SESSION['phoneErr']);
                ?>
            </div>
        <?php
        } else {
        ?>
            <div class="mb-3 text-danger" id="phoneErr"><br></div>
        <?php
        }
        ?>

        <br>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" id="submit">Register</button>
        </div>
    </form>

</body>

</html>