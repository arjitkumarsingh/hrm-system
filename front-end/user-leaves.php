<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Leaves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="crud.js"></script>
</head>

<body>
    <?php
    include "../back-end/get_leaves.php";
    ?>
    <div class="d-flex justify-content-between">
        <a href="admin-dashboard.php"><button class="btn btn-primary mx-5 my-3">Back</button></a>
        <a href="../back-end/logout.php"><button class="btn btn-danger bt-link mx-5 my-3" id="logout" type="button">Logout</button></a>
    </div>

    <div class="mx-5">
        <table id="leave-details" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Days</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($leaves)) {
                    $total_leaves = 0;
                    foreach ($leaves as $leave) {
                ?>
                        <tr>
                            <td><?php echo $leave['id']; ?></td>
                            <td><?php echo $leave['from_date']; ?></td>
                            <td><?php echo $leave['to_date']; ?></td>
                            <td>
                                <?php echo $leave['days'];
                                $total_leaves += $leave['days'];
                                ?>
                            </td>
                            <td><?php echo $leave['reason']; ?></td>
                        </tr>
                    <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Applied for leaves: </th>
                    <td><?php echo count($leaves); ?> times</td>
                    <th>Total Leaves: </th>
                    <td colspan="2"><?php echo $total_leaves; ?></td>
                </tr>
            </tfoot>
        <?php
                }
        ?>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            var userRecord = $('#leave-details').DataTable();
        });
    </script>
</body>

</html>