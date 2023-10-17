<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script src="crud.js"></script>
</head>

<body>
    <?php
    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    include "../back-end/get_user_record.php";
    ?>

    <div class="d-flex justify-content-between">
        <button class="btn btn-primary mx-5 my-3" id="attendance" data-bs-toggle="collapse" type="button" data-bs-target="#attendance-form">Add Attendance</button>
        <a href="leave.php"><button class="btn btn-info bt-link mx-5 my-3" id="leave" type="button">Apply Leave</button></a>
        <a href="../back-end/logout.php"><button class="btn btn-danger bt-link mx-5 my-3" id="logout" type="button">Logout</button></a>
    </div>

    <form action="../back-end/take_attendance.php" method="POST" class="text-center mx-5 mb-5 collapse" id="attendance-form">
        <div class="input-group mb-3">
            <span class="input-group-text">Date: </span>
            <input class="form-control" id="date" type="date" name="date" value="<?php echo date("Y-m-d") ?>" readonly>
        </div>

        <?php
        if (!isset($_SESSION['login'])) {
        ?>
            <div class="input-group mb-3">
                <span class="input-group-text">Login Time: </span>
                <input class="form-control" id="login_time" type="time" name="login_time" value="<?php echo date_format(date_create(), "H:i:s") ?>" readonly>
            </div>

        <?php
        } else {
        ?>
            <div class="input-group mb-3">
                <span class="input-group-text">Logout Time: </span>
                <input class="form-control" id="logout_time" type="time" name="logout_time" value="<?php echo date("H:i:s") ?>" readonly>
            </div>
        <?php
        }
        ?>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#attendance-form">Add</button>
        </div>
    </form>

    <div class="mx-5">
        <table id="user-record" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                    <th>Work Hours</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($records)) {
                    $present = 0;
                    foreach ($records as $record) { ?>
                        <tr>
                            <td><?php echo $record['id']; ?></td>
                            <td><?php echo $record['date']; ?></td>
                            <td>
                                <?php echo $record['login_time'];
                                $present++; ?>
                            </td>
                            <td><?php echo $record['logout_time']; ?></td>
                            <td><?php echo $record['work_hours']; ?></td>
                            <td>
                                <?php if (strtotime($record['work_hours']) >= strtotime("09:00:00")) {
                                    echo "Full Day";
                                } elseif (strtotime($record['work_hours']) >= strtotime("04:00:00") && strtotime($record['work_hours']) <= strtotime("06:00:00")) {
                                    echo "Half Day";
                                } elseif (strtotime($record['work_hours']) >= strtotime("06:00:00") && strtotime($record['work_hours']) <= strtotime("08:30:00")) {
                                    echo "Short Leave";
                                } else {
                                    echo "Full Leave";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total Days: <?php echo count($records); ?></th>
                    <th>Total Presents: <?php echo $present; ?></th>
                    <th colspan="2">Monthly Salary: <?php echo number_format($_SESSION['salary'] * $present / 30, 2); ?></th>
                </tr>
            </tfoot>
        <?php
                }
        ?>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            var userRecord = $('#user-record').DataTable();
        });
    </script>
</body>

</html>