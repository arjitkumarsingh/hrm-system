<?php
require 'connection.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extract the data.
    $request = json_decode($postdata);

    // Validate.
    if (trim($request->name) == '' || trim($request->email) == "" || trim($request->password) == "" || (int)$request->phoneNo < 7000000000) {
        return http_response_code(400);
    }

    // Sanitize.
    $name = mysqli_real_escape_string($conn, trim($request->name));
    $email = mysqli_real_escape_string($conn, trim($request->email));
    $password = mysqli_real_escape_string($conn, trim($request->password));
    $phoneNo = mysqli_real_escape_string($conn, (int)$request->phoneNo);


    // Store.
    $sql = "INSERT INTO `users`(`name`,`email`, `password`, `phone_number`) VALUES ('$name', '$email', '$password', '$phoneNo')";

    if (mysqli_query($conn, $sql)) {
        http_response_code(201);
        $user = [
            'id' => mysqli_insert_id($conn),
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phoneNo' => $phoneNo
        ];
        echo json_encode($user);
    } else {
        http_response_code(422);
    }
}
?>