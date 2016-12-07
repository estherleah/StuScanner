<?php

$conn = mysqli_connect("tcp:gc0216.database.windows.net,1433", "willredmondson@gc0216", "Harvey1Esther2Will3", "OCR");

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

