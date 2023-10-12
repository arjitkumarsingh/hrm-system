<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <form action="../back-end/auth.php" method="POST" class="text-center m-5 p-5" id="login-form">
        <h1>Login Here</h1>
        <br>
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
        session_start();
        if (!empty($_SESSION['error'])) {
        ?>
            <div class="mb-3 text-danger">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php
        } else {
        ?>
            <div class="mb-3 text-danger" id="passwordErr"><br></div>
        <?php
        }
        ?>

        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary" id="submit">Login</button>
        </div>
        <div class="mb-3"><a href="forgot-password.php">Forgot Password</a></div>
    </form>
    <script src="crud.js"></script>

</body>

</html>