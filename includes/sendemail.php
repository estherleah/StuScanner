<?php
if (isset($_POST["forgotPass"])){
    include '../db/dbh.php';
    $email = $conn->real_escape_string($_POST["email"]);
    $data = $conn->query("SELECT email FROM users WHERE email ='$email'");
    if($data ->num_rows>0){
        $str = "0123456789qwertyuioplkjhgfdsazxcvbnm";
        $str = str_shuffle($str);
        $str = substr($str, 0, 10);
        $url = "http://localhost/GC02group16-master/Resetpassword.php?token=$str&email=$email";


//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
        date_default_timezone_set('Etc/UTC');

        require '../PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
        $mail = new PHPMailer;

//Tell PHPMailer to use SMTP
        $mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
        $mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "uclocrgroup2016@gmail.com";

//Password to use for SMTP authentication
        $mail->Password = "haiweizuo";

//Set who the message is to be sent from
        $mail->setFrom('uclocrgroup2016@gmail.com', 'ucl_ocr_group2016');

//Set an alternative reply-to address
//        $mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
        $mail->addAddress($email, 'Dear user');

//Set the subject line
        $mail->Subject = '[UCL Student OCR Feedback Scanning] Forget Password';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

        $mail->Body = "<html>
        <head>
          <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
          <title>[UCL Student OCR Feedback Scanning] Forget Password</title>
        </head>
        <body>
        <div style=\"width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;\">
        <a href=\"http://localhost/GC02group16-master/\"><img src=\"http://i1155.photobucket.com/albums/p545/phonne1/header.png\" alt=\"PHPMailer rocks\"></a>
          <h1>Please reset your password as soon as possible.</h1>
          <div align=\"center\">
            <p>Please note: The following button and link can only be used once</p>
            <a href=\"$url\"><img src=\"http://i1155.photobucket.com/albums/p545/phonne1/click_1_1.png\" alt=\"PHPMailer rocks\"></a>
          </div>
          <p>If the above buttons can not be clicked, please copy the following link to the browser to open:<br></p>
          <p><strong>$url</strong></p>
        </div>
        </body>
        </html>";


//        $mail->Body    = "To reset your passeword, please visit: $url";


//        $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//        $mail->addAttachment('../img/click.png');

//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {


$url1 = "http://localhost/GC02group16-master/index.php?error=messagesent"; ?>
<html>
<head>
<meta http-equiv="refresh" content="0;
url=<?php echo $url1; ?>">
</head>
<body>
waiting 0 second
</body>
</html>

<?php
            $conn->query("UPDATE users SET token='$str' WHERE email='$email'");
}
//        $conn->query("UPDATE users SET token='$str' WHERE email='$email'");

        exit();

    }else{

        header("Location: ../index.php?error=checkemail");
        exit();

    }

}
?>
