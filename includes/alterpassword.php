<?php
session_start ();
include '../db/dbh.php';
$uid = $_POST['username'];
$pwd = $_POST['oldpassword'];
$newpassword = $_POST["newpassword"];
$assertpassword = $_POST["assertpassword"];

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

    $sql = "SELECT * FROM users WHERE uid = '$uid' AND pwd = '$pwd'";
    $result = mysqli_query($conn, $sql);

    if (!$row = mysqli_fetch_assoc($result)){
        echo "username or password is incorrect!";
        header("Location: ../changepassword.php?error=incorrect");
    } else{
        $sql = "UPDATE  users SET pwd='{$newpassword}' WHERE uid='{$uid}'";
        $result = mysqli_query($conn, $sql);
 //       mysqli_query ( "UPDATE  users SET pwd='{$newpassword}' WHERE uid='{$uid}'");
        session_destroy();
        header("Location: ../index.php");
    }
}
