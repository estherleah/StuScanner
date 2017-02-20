<?php
include_once 'quexf-1.18.1/functions/functions.database.php'; //includes session start

/*
 *---------------------------------------------------------------
 * DATA PAGE
 *---------------------------------------------------------------
 *
 *
 * @ELM
 */


global $db;

$json = array();


// check if masquerading as another user
if (isset($_SESSION['masqvid'])) {
    $vid = $_SESSION['masqvid'];
}
else {
    $vid = $_SESSION['vid'];
}


$sql = "SELECT cid FROM formcollections WHERE vid = $vid ORDER BY cid DESC";

$result = $db->getAll($sql);

foreach ($result as $item) {
    $cid = $item['cid'];
    $query="SELECT label, COUNT(f.bid) AS total
	FROM formboxverifychar f RIGHT JOIN boxes b ON b.bid = f.bid JOIN forms c ON f.fid = c.fid
	WHERE b.bgid=1 AND vid = $vid AND cid = $cid
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
