<?php

/*
 *---------------------------------------------------------------
 * FORM DATA PAGE
 *---------------------------------------------------------------
 *
 *
 * @HZ @WE @ELM
 */

include_once 'quexf-1.18.1/functions/functions.database.php'; //includes session start

$json = array();

$cid = $_SESSION['collectionid'];

if (isset($_SESSION['masqvid'])) {
    $vid = $_SESSION['masqvid'];
}
else {
    $vid = $_SESSION['vid'];
}

for ($i=0; $i < 20; $i++) { 
	$bgid = $i + 1;
	$query="SELECT label, COUNT(f.bid) AS total
	FROM formboxverifychar f RIGHT JOIN boxes b ON b.bid = f.bid JOIN forms c ON f.fid = c.fid
	WHERE b.bgid=$bgid AND c.cid = $cid AND vid = $vid
	GROUP BY label
	ORDER BY b.bid";


//execute query
$result = $db->query($query);

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

}

$_SESSION['json_array'] = $json;


?>