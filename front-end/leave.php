<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script src="crud.js"></script>
</head>

<body>

    <div class="d-flex justify-content-between">
        <a href="user-dashboard.php"><button class="btn btn-primary mx-5 my-3">Back</button></a>
        <a href="../back-end/logout.php"><button class="btn btn-danger bt-link mx-5 my-3" id="logout" type="button">Logout</button></a>
    </div>
    <div class="mx-5">
        <table id="users-details" class="table">
            <tr>
                <th>From Date</th>
                <th>To Date</th>
                <th width="100">Days</th>
                <th>Reason</th>
                <th>Action</th>
            </tr>
            <tr>
                <form action="../back-end/apply_leave.php" method="POST" class="text-center mx-5 mb-5" id="leave-form">
                    <td>
                        <input class="form-control" id="from" type="date" name="from" aria-label="from date">
                        <div class="text-danger" id="fromErr-format" style="display: none;">*Invalid date format</div>
                        <div class="text-danger" id="fromErr-past" style="display: none;">*Invalid from date</div>
                    </td>
                    <td>
                        <input class="form-control" id="to" type="date" name="to" aria-label="to date">
                        <div class="text-danger" id="toErr-format" style="display: none;">*Invalid date format</div>
                        <div class="text-danger" id="toErr-past" style="display: none;">*Invalid to date</div>
                    </td>
                    <td><input class="form-control" id="days" name="days" type="number" value="" readonly></td>
                    <td>
                        <textarea class="form-control" rows="3" id="reason" name="reason" placeholder="What is your reason for leave" aria-label="reason for your leave"></textarea>
                        <div class="text-danger" id="reasonErr-required" style="display: none;">*Reason is required</div>
                        <div class="text-danger" id="reasonErr-short" style="display: none;">*Reason is too short</div>
                        <!-- <div class="text-danger" id="reasonErr-invalid" style="display: none;">*Only _ - ' : ( ) spacial characters are allowed</div> -->
                    </td>
                    <td><button type="submit" class="btn btn-primary my-4" id="submit">Apply</button></td>
                </form>
            </tr>
        </table>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#reason'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>