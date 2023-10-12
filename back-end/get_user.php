<?php
require 'connection.php';


    // Fetch user
    $sql = "SELECT * FROM `users` WHERE `id` = '$_GET[id]'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        http_response_code(200);
        $user = (mysqli_fetch_assoc($result));
        //  echo json_encode($user);
        // echo "User logged in";
    } else {
        http_response_code(422);
        echo "Error in fetching user details";
    }
?>