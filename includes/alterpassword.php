<?php
session_start ();
include '../db/dbh.php';
$uid = $_POST['username'];
$pwd = $_POST['oldpassword'];
$hash = base64_encode(sha1($pwd, true));
$newpassword = $_POST["newpassword"];
$hashnew1 = base64_encode(sha1($newpassword, true));
$assertpassword = $_POST["assertpassword"];
$hashnew2 = base64_encode(sha1($assertpassword, true));

if (empty($uid)){
    header("Location: ../changepassword.php?error=empty");
    exit();
}
if (empty($pwd)){
    header("Location: ../changepassword.php?error=empty");
    exit();
}
if ($newpassword !== $assertpassword) {
    header("Location: ../changepassword.php?error=notsame");
    exit();
}else{

    $sql = "SELECT * FROM users WHERE uid = '$uid' AND pwd = '$hash'";
    $result = mysqli_query($conn, $sql);

    if (!$row = mysqli_fetch_assoc($result)){
//        echo "username or password is incorrect!";
        header("Location: ../changepassword.php?error=incorrect");
        exit();
    } else{
        $sql = "UPDATE  users SET pwd='{$hashnew1}' WHERE uid='{$uid}'";
        $result = mysqli_query($conn, $sql);
 //       mysqli_query ( "UPDATE  users SET pwd='{$newpassword}' WHERE uid='{$uid}'");
        session_destroy();
        header("Location: ../index.php?changesuc");
    }
}
