<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="crud.js"></script>
</head>

<body>
    <?php
    session_start();
    include "../back-end/get_user.php";
    include "../back-end/get_roles.php";
    ?>

    <div class="d-flex justify-content-between">
        <a href="admin-dashboard.php"><button class="btn btn-primary mx-5 my-3">Back</button></a>
        <a href="../back-end/logout.php"><button class="btn btn-danger bt-link mx-5 my-3" id="logout" type="button">Logout</button></a>
    </div>
    <div class="mx-5">
        <table id="users-details" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone No.</th>
                    <th>Salary</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="../back-end/update_user.php" method="post" id="update-form" enctype="multipart/form-data">
                        <td><input class="form-control" id="id" type="number" name="id" value="<?php echo $user['id']; ?>" aria-label="id" readonly></td>
                        <td>
                            <img src="../back-end/images/<?php echo $user['image']; ?>" alt="user image" width="120px" height="100px" class="mb-3">
                            <input class="form-control" id="image" type="file" name="image" value="../back-end/images/<?php echo $user['image']; ?>" aria-label="id">
                        </td>
                        <td><input class="form-control" id="name" type="text" name="name" value="<?php echo $user['name']; ?>" aria-label="name"></td>
                        <td><input class="form-control" id="email" type="email" name="email" value="<?php echo $user['email']; ?>" aria-label="email"></td>
                        <td>
                            <div class="d-inline-flex">
                                <input class="form-control" id="password" type="password" name="password" value="<?php echo $user['password']; ?>" aria-label="password">
                                <span id="toggle-password" class="fs-5 badge"><a href="javascript:void(0)" class="text-reset"><i id="eye" class="bi bi-eye"></i></a></span>
                            </div>
                        </td>
                        <td><input class="form-control" id="phone" type="number" name="phone" value="<?php echo $user['phone_number']; ?>" aria-label="phone number"></td>
                        <td><input class="form-control" id="salary" type="number" name="salary" value="<?php echo $user['salary']; ?>" aria-label="salary"></td>
                        <td>
                            <select name="role" id="role" class="form-control form-select">
                                <?php foreach ($roles as $role) { ?>
                                    <option value="<?php echo $role['id']; ?>" <?php if ($user['role'] == $role['id']) echo "selected"; ?>>
                                        <?php echo $role['role']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><button type="submit" class="btn btn-primary"><i class="bi bi-save"></button></td>
                    </form>
                </tr>
            </tbody>
            <?php
            if (isset($_SESSION['nameErr']) || isset($_SESSION['emailErr']) || isset($_SESSION['passwordErr']) || isset($_SESSION['phoneErr']) || isset($_SESSION['imageErr'])) { ?>
                <tfoot>
                    <th>Errors: </th>
                    <td class="text-danger">
                        <?php
                        if (isset($_SESSION['imageErr'])) {
                            echo $_SESSION['imageErr'];
                            unset($_SESSION['imageErr']);
                        }
                        ?>
                    </td>
                    <td class="text-danger">
                        <?php
                        if (isset($_SESSION['nameErr'])) {
                            echo $_SESSION['nameErr'];
                            unset($_SESSION['nameErr']);
                        }
                        ?>
                    </td>
                    <td class="text-danger">
                        <?php
                        if (isset($_SESSION['emailErr'])) {
                            echo $_SESSION['emailErr'];
                            unset($_SESSION['emailErr']);
                        }
                        ?>
                    </td>
                    <td class="text-danger">
                        <?php
                        if (isset($_SESSION['passwordErr'])) {
                            echo $_SESSION['passwordErr'];
                            unset($_SESSION['passwordErr']);
                        }
                        ?>
                    </td>
                    <td class="text-danger">
                        <?php
                        if (isset($_SESSION['phoneErr'])) {
                            echo $_SESSION['phoneErr'];
                            unset($_SESSION['phoneErr']);
                        }
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tfoot>
            <?php } ?>
        </table>
    </div>
</body>

</html>