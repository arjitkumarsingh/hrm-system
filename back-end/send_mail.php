<?php
session_start();
require_once "connection.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "src/Exception.php";
require "src/PHPMailer.php";
require "src/SMTP.php";

// Fetch user
$sql = "SELECT * FROM `users` WHERE `email` = '$_POST[email]'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    http_response_code(200);
    $user = (mysqli_fetch_assoc($result));
    //  echo json_encode($user);

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'arjit.softgen@gmail.com';                     //SMTP username
        $mail->Password   = 'dwtx wpzb mhxe hcyf';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('arjit.softgen@gmail.com', 'HRM System');
        $mail->addAddress($_POST['email']);     //Add a recipient
        // $mail->addAddress('arjitkumarsingh@gmail.com');               //Name is optional
        $mail->addReplyTo('arjit.softgen@gmail.com', 'HRM System');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Forgot Password';
        $mail->Body    = 'Your password is: <b>' . $user['password'] . '</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo json_encode('Message has been sent');
        $_SESSION['msg'] = "An email containing your password has been sent";
        header("location: ../front-end/forgot-password.php"); // will not work because of echo statements in src files of src folder.
        echo "<script type='text/javascript'>window.location.href='../front-end/forgot-password.php'</script>";
    } catch (Exception $e) {
        // echo json_encode("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        $_SESSION['error'] = "Email could not be sent. Mailer Error";
        echo "<script type='text/javascript'>window.location.href='../front-end/forgot-password.php'</script>";
    }
} else {
    http_response_code(422);
    $_SESSION['error'] = "Email-id not found";
    echo "<script type='text/javascript'>window.location.href='../front-end/forgot-password.php'</script>";
    // echo json_encode("Email-id not found");
}
?>