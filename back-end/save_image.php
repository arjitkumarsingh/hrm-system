<?php
// session_start();
$_SESSION['imageErr'] = "";

$file_name = basename($_FILES["image"]["name"]);
$target_dir = "images/" . $file_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $_SESSION['imageErr'] = "File is not an image. ";
        $uploadOk = 0;
    }
}

// Check if file already exists
// if (file_exists("images/" . $file_name)) {
//     // echo "Sorry, file already exists.";
//     $_SESSION['imageErr'] .= "Image already exists. ";
//     $uploadOk = 0;
// }

// Check file size
if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
    // echo "Sorry, your file is too large.";
    $_SESSION['imageErr'] .= "Image size must be less than 2MB. ";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png") {
    // echo "Sorry, only JPG & PNG files are allowed.";
    $_SESSION['imageErr'] .= "Image extension must be .jpg or .png. ";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir)) {
        // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
        $_SESSION['imageErr'] .= "Error in uploading image";
    }
}
?>