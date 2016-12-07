<?php

// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:gc0216.database.windows.net,1433; Database = OCR", "willredmondson", "Harvey1Esther2Will3");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "willredmondson@gc0216", "pwd" => "Harvey1Esther2Will3", "Database" => "OCR", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:gc0216.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

?>

