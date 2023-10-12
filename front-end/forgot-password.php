<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="crud.js"></script>
</head>

<body>
    <form action="../back-end/send_mail.php" method="POST" class="text-center m-5 p-5" id="password-form">
        <h1>Enter the registered email-id</h1>
        <br>
        <div class="input-group mb-3">
            <span class="input-group-text">Email: </span>
            <input class="form-control" id="email" type="email" name="email" placeholder="xyz@example.com" aria-label="email id">
        </div>

        <?php
        session_start();
        if (!empty($_SESSION['msg'])) {
        ?>
            <div class="mb-3 text-success">
                <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                ?>
            </div>
        <?php
        } elseif (!empty($_SESSION['error'])) {
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
            <div class="mb-3"><br></div>
        <?php
        }
        ?>

        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>

</html>