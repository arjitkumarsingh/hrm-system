<?php
require 'connection.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extract the data.
    $request = json_decode($postdata);

    // Validate.
    if (trim($request->email) == "" || trim($request->password) == "") {
        return http_response_code(400);
    }

    // Sanitize.
    $email = mysqli_real_escape_string($conn, trim($request->email));
    $password = mysqli_real_escape_string($conn, trim($request->password));

    // Fetch.
    $sql = "SELECT `id`, `name`, `email`, `role` FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        http_response_code(200);
        $user = mysqli_fetch_assoc($result);
        echo json_encode($user);
    } else {
        http_response_code(422);
    }
}
?>