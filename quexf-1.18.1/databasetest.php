<?php
	
	//include_once "config.inc.php";
	include_once "db.inc.php";

	global $db;

	if(!isset($db)){
		echo "db not set";
	}else{
		$sql = "SELECT username FROM users";
		$result = $db->GetAll($sql);
		echo "Database is working if the users are printed w/o errors<br>";
		foreach($result as $row){
			foreach($row as $cell){
				echo $cell."<br>";
			}
		}
}