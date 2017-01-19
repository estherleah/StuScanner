<?php

/*	Copyright Deakin University 2007,2008
 *	Written by Adam Zammit - adam.zammit@deakin.edu.au
 *	For the Deakin Computer Assisted Research Facility: http://www.deakin.edu.au/dcarf/
 *	
 *	This file is part of queXF
 *	
 *	queXF is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation; either version 2 of the License, or
 *	(at your option) any later version.
 *	
 *	queXF is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *	
 *	You should have received a copy of the GNU General Public License
 *	along with queXF; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */


session_start();
include_once(dirname(__FILE__).'/../config.inc.php');
include_once(dirname(__FILE__).'/../db.inc.php');


/*
 * WILL HAS ADDED
 */

function get_cid(){

    if( isset($_SESSION['cid'])){
        $cid = $_SESSION['cid'];
        echo $cid;
        return $cid;
    }
    else {
        echo "cid not set please log in";
        return false;
    }
}

/**
 *  Given the uid returns the vid stored in the logintest database
 *
 */
function uid_to_vid($uid){

	$conn = mysqli_connect("localhost", "root", "", "logintest");

    if (!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }

    $sql = "SELECT vid FROM users WHERE uid = '$uid'";

    $rs = mysqli_query($conn, $sql);

	$rs = $rs->fetch_row()[0];

    return $rs;

}

// returns cids for current vid
function get_collections(){

    global $db;

    $result = array();

    $vid = get_vid();

    $sql = "SELECT * FROM formcollections WHERE vid = '$vid' ORDER BY cid DESC";

    $rs = $db->getAll($sql);
    //echo $vid;
    //echo $rs ? "succ" : "fail";

    if(count($rs) < 1 )
    {
        echo "You currently have no collections on record, click new collection to create your first collection.";
        return false;
    }

    foreach ($rs as $cid ) {
          array_push($result, $cid);
    }

    return $result;
}

// returns previous 4 collections for current vid
function get_last_collections(){

    global $db;

    $result = array();

    $vid = get_vid();

    $sql = "SELECT * FROM formcollections WHERE vid = '$vid' ORDER BY cid DESC LIMIT 4";

    $rs = $db->getAll($sql);
    //echo $vid;
    //echo $rs ? "succ" : "fail";

    if(count($rs) < 1 )
    {
        echo "You currently have no collections on record, click new collection to create your first collection.";
        return false;
    }

    foreach ($rs as $cid ) {
          array_push($result, $cid);
    }

    return $result;
}

//creates a new row in the formcollections database edits cid session variable ready for import
function new_collection(){

    global $db;

    $vid = get_vid();

    $sql = "INSERT INTO formcollections (vid) VALUES ('$vid')";

    $query = $db->Execute($sql);

    if($query){
        //echo "SUCCESS";
    } else {
        //echo "FAILED";
    }

    $sql = "SELECT MAX(cid) FROM  formcollections";

    $rs = $db->GetRow($sql);

    $new_cid = $rs['MAX(cid)'];

    $_POST['collection'] = $new_cid;


}

//update the values in the collection database
function update_collection($cid, $vid, $description, $qid)
{
    global $db;

    echo $cid.$vid.$description.$qid;

    $sql = "UPDATE formcollections
            SET vid = '$vid',
				description = '$description',
				qid = '$qid'
				WHERE cid = '$cid'";

    if( $db->Execute($sql)){
        echo "Collection Updated<br>";
    } else {
        echo "Update Failed<br>";
    }


}

//Gets the number of multiple choice/array box groups for a given questionnaire
function get_bgid_max(){

    global $db;

    $sql = "SELECT MAX(bgid) FROM boxgroupstype WHERE btid = 1";

    $rs = $db->GetRow($sql);

    return $rs['MAX(bgid)'];

}

//returns an array of bgids corresponding from a given fid
function get_bgids_from_cid( $cid, $option = 1){

    global $db;

    $result = array();
	/*
    //$cid = get_cid();// This as an input parameter when looking managing

    $sql ="SELECT qid FROM formcollections WHERE cid = '$cid'";

    $qid_rs = $db->getAll($sql);

	$qid_rs = 1;
    if(count($qid_rs) > 1)
    {
        echo "error converting fid to qid too many results";
        return false;
    }

    foreach ($qid_rs as $qid_row) {

        $qid = $qid_row['qid'];
	*/
	//hardcoded
	$qid = 1;
        $sql = "SELECT pid FROM pages WHERE qid = '$qid'";

        $pid_rs = $db->getAll($sql);

        if (count($pid_rs) <= 0) {
            echo "error converting qid to fid too few results";
            return false;
        }

        foreach ($pid_rs as $pid_row) {

            $pid = $pid_row['pid'];

            if($option != 0){
                $sql = "SELECT bgid 
                  FROM boxgroupstype 
                  WHERE (pid = '$pid')";
            } else {
                $sql = "SELECT bgid 
                  FROM boxgroupstype 
                  WHERE (pid = '$pid') AND (btid = 1)";
            }

            $bgid_rs = $db->getAll($sql);

            if (count($pid_rs) == 0) {
                echo "error no box groups found for those pages.";
                return false;
            }

            foreach ($bgid_rs as $bgid_row) {

                $bgid = $bgid_row['bgid'];
                array_push($result,$bgid);
            }

    }
    return $result;
}

//returns the description of a question from a given bgid
function get_question_description($bgid){

    global $db;

    $db->StartTrans();

    $sql = "SELECT label FROM boxgroupstype WHERE bgid = '$bgid'";

    $rs = $db->GetRow($sql);

    if (empty($rs))
        return "Question Label Unavailable";
    else
    {
        return $rs['label'];
    }
}

//gets the varname from the given bgid
function get_question_varname($bgid){

    global $db;

    $db->StartTrans();

    $sql = "SELECT * FROM boxgroupstype WHERE bgid = '$bgid'";

    $rs = $db->GetRow($sql);

    if (empty($rs))
        return "Question Label Unavailable";
    else
    {
        return $rs['varname'];
    }
}

/*
 *  End OF WILL ADDED
 */
/* Sort box groups by pageid then box tly tlx
 *
 */
function sort_order_pageid_box($qid)
{
	global $db;


	$db->StartTrans();

	$sql = "SELECT b.bgid as bgid , p.pidentifierval, bx.tlx, bx.tly
		FROM `boxgroupstype` AS b, pages AS p, boxes as bx
		WHERE p.qid = '$qid'
		AND b.bgid = bx.bgid
		AND bx.pid = p.pid
		GROUP BY b.bgid
		ORDER BY p.pidentifierval ASC , bx.tly ASC , bx.tlx ASC";

	$all = $db->GetAll($sql);

	$i = 0;
	foreach ($all as $row)
	{
		$sql = "UPDATE boxgroupstype
			SET sortorder = '$i'
			WHERE bgid = '{$row['bgid']}'";

		$db->Execute($sql);

		$i++;
	}

	$db->CompleteTrans();

}

/* Sort box groups by their variable name
 *
 */
function sort_order_varname($qid)
{
	global $db;


	$db->StartTrans();

	$sql = "SELECT b.bgid as bgid
		FROM `boxgroupstype` AS b, pages AS p
		WHERE p.qid = '$qid'
		AND b.pid = p.pid
		ORDER BY b.varname ASC";

	$all = $db->GetAll($sql);

	$i = 0;
	foreach ($all as $row)
	{
		$sql = "UPDATE boxgroupstype
			SET sortorder = '$i'
			WHERE bgid = '{$row['bgid']}'";

		$db->Execute($sql);

		$i++;
	}

	$db->CompleteTrans();

}


/*
 * Assign the next free form to a verifier
 */

function assign_to($vid)
{
	global $db;

	$db->StartTrans();

/*
	$sql = "SELECT f.fid as fid
		FROM forms as f
		WHERE f.done = 0 and f.assigned_vid is NULL
		ORDER BY f.fid ASC 
		LIMIT 1";
 */

	//only assign a form if none currently assigned
	$sql = "SELECT f.fid as fid
		FROM forms as f
		WHERE f.done = 0
		AND f.assigned_vid = '$vid'";

	$rs = $db->GetAll($sql);

	if (!empty($rs))
	{
		if (count($rs) == 1)
		{
			return $rs[0]['fid'];
		}
		else if (count($rs) > 1)
		{
			print T_("ERROR: Multiple forms assigned, please see a technical officer");
			exit();
		}
	}


	//only get forms that are assigned to this verifier

	$sql = "SELECT f.fid AS fid
		FROM forms AS f
		JOIN verifierquestionnaire AS v ON (v.vid = '$vid' AND f.qid = v.qid) ";

	if (!MISSING_PAGE_ASSIGN){
		$sql .= " LEFT JOIN missingpages AS m ON (f.fid = m.fid) ";
	}

	$sql .= " WHERE f.done =0
		AND f.assigned_vid IS NULL ";

	if (!MISSING_PAGE_ASSIGN) {
		$sql .= " AND m.fid IS NULL ";
	}

	if (!VERIFY_WITH_MISSING_PAGES)
	{
		$sql .= "AND NOT EXISTS(
				SELECT p.pid
				FROM pages AS p
				WHERE  p.qid = f.qid
				AND NOT EXISTS 
				(SELECT fp.fid 
					FROM formpages AS fp 
					WHERE fp.fid = f.fid 
					AND fp.pid = p.pid))";
	}

        $sql .= " ORDER BY f.fid ASC
		LIMIT 1";


	$rs = $db->GetRow($sql);

	$fid = false;

	if (!empty($rs))
	{
		$fid = $rs['fid'];
		
		$sql = "UPDATE verifiers
			SET currentfid = '$fid'
			WHERE vid = '$vid'";

		//WILL this is the point where a form is assigned in the database
		//TODO add verifier into the collectionverify table?
		$db->Execute($sql);
	}

	$db->CompleteTrans();

	return $fid;

}



function assign_to_merge($vid)
{
	global $db;

	$db->StartTrans();

	//only get the next form where exactly 2 people have verified it

	$sql = "SELECT fid
		FROM worklog
		GROUP BY fid
		HAVING COUNT(*) = 2
		LIMIT 1";

	$rs = $db->GetRow($sql);

	$fid = false;

	if (!empty($rs))
	{
		$fid = $rs['fid'];
	}

	$db->CompleteTrans();

	return $fid;

}



function get_vid()
{
    if (isset($_SESSION['masqvid'])) {
        $vid = $_SESSION['masqvid'];
    }
    else {
        $vid = $_SESSION['vid'];
    }
	return $vid;

}


function get_fid($vid)
{
	global $db;


	$sql = "SELECT fid
		FROM forms
		WHERE assigned_vid = '$vid'
		AND done = 0";

	$rs = $db->GetRow($sql);

	if (empty($rs))
		return false;//invalid user
	else
	{
		if (empty($rs['fid']))
		{
			//assign a form
		}else
		{
			return $rs['fid'];
		}
	}
	return false;

}


function detect_differences()
{
	global $db;

	$sql = "SELECT fid
		FROM worklog
		GROUP BY fid
		HAVING COUNT(*) = 2";

	$r = $db->GetAll($sql);

	foreach ($r as $f)
	{
		$fid = $f['fid'];
		print "$fid: <br/>";
		
		$sql = "SELECT vid 
			FROM worklog
			WHERE fid = $fid";

		$vids = $db->GetAll($sql);

		$vid1 = $vids[0]['vid'];
		$vid2 = $vids[1]['vid'];

		$q = get_qid_description($fid);
		$qid = $q['qid'];

		$sql = "SELECT b.bid AS bid
			FROM boxes AS b
			JOIN boxgroupstype as bg ON (bg.bgid = b.bgid)
			JOIN pages as p ON (p.pid = b.pid)
			LEFT JOIN formboxverifychar AS c2 ON c2.fid = '$fid'
			AND c2.vid = '$vid1'
			AND c2.bid = b.bid
			LEFT JOIN formboxverifychar AS c ON c.fid = '$fid'
			AND c.vid = '$vid2'
			AND c.bid = b.bid
			WHERE (bg.btid  =1  or bg.btid = 2)
			AND p.qid = '$qid'
			AND c.val != c2.val";

		$diffs = $db->GetAll($sql);

		foreach($diffs as $diff)
		{
			print_r($diff);
			print "<br/>";
		}

	}

}



function get_qid_description($fid)
{
	global $db;

	$sql = "SELECT qid,description
		FROM `forms` 
		WHERE fid = '$fid'";

	$rs = $db->GetRow($sql);

	return $rs;
}



?>
