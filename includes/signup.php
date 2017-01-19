<?php

include '../db/dbh.php';
include_once '../quexf-1.18.1/functions/functions.database.php';

$uid = $_POST['uid'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
//$admin = $_POST['admin'];

//TODO additional checks for the htpasswd file for example no ":" in username or password

//check password miss match
if ($pwd !== $pwd2) {
    header("Location: ../index.php?error=notsame");
    exit();
}
//check username
if (empty($uid)){
    header("Location: ../index.php?error=userempty");
    exit();
}

//check email
if (empty($email)){
    header("Location: ../index.php?error=emailempty");
    exit();
}


//check passwd
if (empty($pwd)){
    header("Location: ../index.php?error=passwordempty");
    exit();
}

else {

    $sql = "SELECT uid FROM users WHERE uid='$uid'";
    $result = mysqli_query($conn, $sql);
    $uidcheck = mysqli_num_rows($result);

    $sql1 = "SELECT uid FROM users WHERE email='$email'";
    $result1 = mysqli_query($conn, $sql1);
    $emailcheck = mysqli_num_rows($result1);


    //check if name is taken
    if($uidcheck > 0){
        header("Location: ../index.php?error=username");
        exit();

    }

    //check if email is taken
    if($emailcheck > 0) {
        header("Location: ../index.php?error=emailexist");
        exit();
    }


    else{

        //create new operator in quexf database
        echo "creating the verifiers";
        $sql = "INSERT INTO verifiers (vid, description, currentfid, http_username) VALUES ( NULL, '$uid', NULL, '$uid')";

        $verifier_set = $db->Execute($sql);
        echo $verifier_set ? "success<br>" : "failed<br>";

        $vid = mysql_insert_id ();
        echo "vid ".$vid;

        //insert new row in htpasswd for apache access
        $hash = base64_encode(sha1($pwd, true));
        $contents = $uid . ':{SHA}' . $hash.PHP_EOL;
        echo exec("pwd");
        file_put_contents('../passwrd/.htpasswd', $contents, FILE_APPEND);

        //TODO set as the current user : this should be in the login page
        //$_SERVER['PHP_AUTH_USER'] = $vid;


        $sql = "INSERT INTO users ( uid, email, pwd, admin, vid) VALUES ( '$uid','$email', '$hash', '0', $vid)";

        $result = mysqli_query($conn, $sql);

        header("Location: ../index.php?success");
    }
}

?>
