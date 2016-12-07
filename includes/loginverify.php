<?php
session_start();
include '../db/dbh.php';


$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

$sql1 = "USE azuredb;
CREATE TABLE IF NOT EXISTS users (
  uid VARCHAR(25) NOT NULL,
  email VARCHAR(100) NOT NULL,
  pwd VARCHAR(100) NOT NULL,
  admin TINYINT(1) NOT NULL
) ENGINE=InnoDB";
$result1 = mysqli_query($conn, $sql1);

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

