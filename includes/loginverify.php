<?php
session_start();
include '../db/dbh.php';


$uid = $_POST['uid'];
$pwd = $_POST['pwd'];
$hash = base64_encode(sha1($pwd, true));

$sql = "SELECT * FROM users WHERE uid = '$uid' AND pwd = '$hash'";
$result = mysqli_query($conn, $sql);

if (!$row = mysqli_fetch_assoc($result)){
    echo "Your username or password is incorrect!";
    header("Location: ../index.php?error=incorrect");
} else{
    $_SESSION['vid'] = $row['vid'];
    $_SESSION['uid'] = $row['uid'];
    $_SESSION['admin'] = $row['admin'];
    $_SESSION['uid'] = $row['uid'];
    header("Location: ../dashboard.php");
}

?>