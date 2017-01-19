<?php

if(isset($_GET["email"])){
    include '../db/dbh.php';

    $email = $conn->real_escape_string($_GET["email"]);


    $data=$conn->query("SELECT * FROM users WHERE email='$email'");

    if($data->num_rows>0){

//        $str="0123456789qwertyuioplkjhgfdsazxcvbnm";
//        $str = str_shuffle($str);
//        $str = substr($str, 0, 15);

        $admin = 1;
        $conn->query("UPDATE users SET admin = '$admin' WHERE email ='$email'");




        $url1 = "http://localhost/GC02group16-master/index.php";
        ?>


        <html>
        <link rel="icon" type="image/png" href="img/ucl-icon.gif" />
        <head>
            <meta http-equiv="refresh" content="3;
url=<?php echo $url1; ?>">
        </head>
        <body>
        <h1>Success!</h1>
        <p><strong>  <p><?php  echo $email ?></p></strong> has obtain administrator privileges</p>
        <p>Will jump to login page automatically...</p>
        </body>
        </html>


        <?php




    }else echo "please check your link!";

}else{

}

?>