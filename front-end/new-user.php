<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="crud.js"></script>
</head>

<body>
    <?php
    session_start();
    include "../back-end/get_roles.php";
    ?>

    <div class="d-flex justify-content-between">
        <a href="admin-dashboard.php"><button class="btn btn-primary mx-5 my-3">Back</button></a>
        <a href="../back-end/logout.php"><button class="btn btn-danger bt-link mx-5 my-3" id="logout" type="button">Logout</button></a>
    </div>

    <div class="mx-1">
        <form action="../back-end/save_user.php" method="POST" class="text-center mx-5 mb-5" id="new-user-form" enctype="multipart/form-data">


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
                <input class="form-control" id="image" type="file" name="image" aria-label="user photo">
            </div>
            <?php
            if (isset($_SESSION['imageErr'])) {
            ?>
                <div class="mb-3 text-danger">
                    <?php
                    echo $_SESSION['imageErr'];
                    unset($_SESSION['imageErr']);
                    ?>
                </div>
            <?php
            } else {
            ?>
                <div class="mb-3 text-danger" id="imageErr"><br></div>
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
                <div class="mb-3 text-danger" id="phoneErr">
                    <br>
                </div>
            <?php
            }
            ?>


            <div class="input-group mb-3">
                <span class="input-group-text">Salary: </span>
                <input class="form-control" id="salary" type="number" name="salary" placeholder="Monthly Salary" aria-label="Salary">
            </div>

            <div class="mb-3">
                <br>
            </div>

            <?php if (isset($roles)) { ?>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="role">Role: </label>
                    <select name="role" id="role" class="form-control form-select">
                        <option value=2 hidden>Choose a role : Default is user</option>
                        <?php foreach ($roles as $role) { ?>
                            <option value="<?php echo $role['id']; ?>"><?php echo $role['role']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" id="submit">Add</button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>