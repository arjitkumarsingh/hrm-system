<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script src="crud.js"></script>
</head>

<body>
    <?php
    include "../back-end/get_users.php";
    ?>
    <div class="d-flex justify-content-between">
        <a href="new-user.php"><button class="btn btn-primary mx-5 my-3">Add New User</button></a>
        <a href="../back-end/logout.php"><button class="btn btn-danger bt-link mx-5 my-3" id="logout" type="button">Logout</button></a>
    </div>

    <div class="mx-5">
        <table id="users-details" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone No.</th>
                    <th>User Leaves</th>
                    <th>Salary</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($users)) {
                    foreach ($users as $user) {
                ?>
                        <tr id="row-<?php echo $user['id']; ?>">
                            <td><?php echo $user['id']; ?></td>
                            <td>
                                <?php if (!empty($user['image'])) { ?>
                                    <img src="../back-end/images/<?php echo $user['image']; ?>" alt="user image" width="120px" height="100px">
                                <?php } ?>
                            </td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['password']; ?></td>
                            <td><?php echo $user['phone_number']; ?></td>
                            <td><a href="user-leaves.php?id=<?php echo $user['id']; ?>">See Leaves</a></td>
                            <td><?php echo $user['salary']; ?></td>
                            <td><?php
                                if ($user['role'] == 1) {
                                    echo "Admin";
                                } else {
                                    echo "User";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="update.php?id=<?php echo $user['id']; ?>"><i class="bi bi-pencil" id="edit-<?php echo $user['id']; ?>"></i></a>
                                &nbsp; &nbsp;
                                <a href="../back-end/delete_user.php?id=<?php echo $user['id']; ?>"><i class="bi bi-trash3" id="delete-<?php echo $user['id']; ?>"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="10">Total number of Employees: <?php echo count($users); ?></th>
                </tr>
            </tfoot>
        <?php
                }
        ?>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            var userRecord = $('#users-details').DataTable();
        });
    </script>
</body>

</html>