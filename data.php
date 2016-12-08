<?php

//session_start();

//setting header to json
//header('Content-Type: application/json');
include 'db/dbh.php';

//database
//define('DB_HOST', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'quexf');

//get connection
//$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

//if(!$mysqli){
//	die("Connection failed: " . $mysqli->error);
//}

//query to get data from the table

$json = array();

for ($i=0; $i < 20; $i++) { 
	$bgid = $i + 1;
	$query="SELECT label, COUNT(f.bid) AS total
	FROM boxes b LEFT JOIN formboxverifychar f ON b.bid = f.bid
	WHERE b.bgid=$bgid
	GROUP BY label
	ORDER BY b.bid";

//print question number
//echo "Question $bgid:<br>";


//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//now print the data
$json_string = json_encode($data);
array_push($json,$json_string);
//echo "<br><br>";
}

$_SESSION['json_array'] = $json;

//close connection
$mysqli->close();
?>