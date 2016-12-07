<?php

$conn = mysqli_connect("gc0216.database.windows.net", "willredmondson", "Harvey1Esther2Will3", "OCR");

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

