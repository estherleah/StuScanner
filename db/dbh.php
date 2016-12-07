<?php

$conn = mysqli_connect("gc0216.database.windows.net", "willredmondson@gc0216", "Harvey1Esther2Will3", "OCR");

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

