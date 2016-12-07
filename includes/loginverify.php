<?php
session_start();
include '../db/dbh.php';


$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM users WHERE uid = '$uid' AND pwd = '$pwd'";
$result = mysqli_query($conn, $sql);

if (!$row = mysqli_fetch_assoc($result)){
    echo "Your username or password is incorrect!";
    header("Location: ../index.php?error=incorrect");
} else{
    $_SESSION['uid'] = $uid;
    $_SESSION['admin'] = $row['admin'];

    header("Location: ../dashboard.php");
}

