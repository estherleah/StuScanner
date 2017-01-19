<?php
/*
 *---------------------------------------------------------------
 * RESET PASSWORD
 *---------------------------------------------------------------
 *
 *
 * @HZ
 */


if(isset($_GET["email"]) && isset($_GET["token"])){
    include 'db/dbh.php';

    $email = $conn->real_escape_string($_GET["email"]);
    $token = $conn->real_escape_string($_GET["token"]);

    $data=$conn->query("SELECT * FROM users WHERE email='$email' AND token='$token'");

    if($data->num_rows>0){

//        $str="0123456789qwertyuioplkjhgfdsazxcvbnm";
//        $str = str_shuffle($str);
//        $str = substr($str, 0, 15);
        $password = 66666666;
        $hash = base64_encode(sha1($password, true));

       $conn->query("UPDATE users SET pwd = '$hash',token = '' WHERE email ='$email'");



        $url1 = "http://localhost/GC02group16-master/index.php?error=resetpass";
        ?>


        <html>
        <link rel="icon" type="image/png" href="img/ucl-icon.gif" />
        <head>
            <meta http-equiv="refresh" content="3;
url=<?php echo $url1; ?>">
        </head>
        <body>
        <h1>Verify success!</h1>
        <p><strong>Your Temporary password is: 66666666</strong></p>
        <p>Please login and change your password as soon as possible!</p>
        <p>Will jump to login page automatically...</p>
        </body>
        </html>


<?php




    }else echo "please check your link!";

}else{

}

?>