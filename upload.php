
<?php

/*
 *---------------------------------------------------------------
 * UPLOAD
 *---------------------------------------------------------------
 *  This page prepares the uploaded files and formcollections
 *  table in the quexf db for the process of verification
 *
 * @WE
 */



include 'quexf-1.18.1/functions/functions.import.php';
include 'quexf-1.18.1/functions/functions.database.php'; //session_start included
include("quexf-1.18.1/functions/functions.xhtml.php");
include("quexf-1.18.1/functions/functions.process.php");

echo "<h1>Upload stage</h1>";

//test that there are files to be uploaded
if(!isset($_FILES['fileList']['name'][0]))
{
    header("Location: dashboard.php");
}

if(!isset($_POST['collection']))
{
    //increment collections database
    new_collection();
    echo "new collection created<br>";

    //set the collection name
    if($description = $_POST['description'] == "") {
        $description = 'my_collection_' . $current_cid;
    } else {
        $description = $description = $_POST['description'];
    }
    $current_cid = $_POST['collection'];
    $_SESSION['current_collection']=$current_cid;
    $vid = get_vid();
    $qid = 1;
    echo "Collection description : ".$description."<br>";

    //update the collection in 'formcollections' table in db
    update_collection($current_cid, $vid, $description, $qid);

} else {

    //when adding to a collecition
    echo $_POST['collection'];
    echo "collection previously set as a post variable<br>";
    $description = $_POST['collection'];

}


$current_cid = $_POST['collection'];

//set current collection
$_SESSION['current_collection']=$current_cid;

$vid = get_vid();

/*
 * This is the point in which the qid is hard coded.
 * The application will only verify forms with a
 * qid of 1, the first questionnaire in the database.
 *
 */
$qid = 1;

//path for files not uploaded
$targetpath = "uploads/";

//remove all current files from targetpath
array_map('unlink', glob("uploads/*"));


//move selected files to upload directory
$continue = 0;
for( $i = 0 ; $i < sizeof($_FILES['fileList']['name']) ; $i++) {
    echo $i." ";
    $temp_name = $_FILES['fileList']['tmp_name'][$i];
    echo $name = basename($_FILES['fileList']['name'][$i]);
    echo move_uploaded_file( $temp_name , "$targetpath/$name" ) ? " Successfully Moved to /upload<br>" : "unsuccessfully moved to upload<br>";
}


//import this directory
import_directory($targetpath);



//set the verifier to current user and set cid to current cid
$vid = get_vid();


$sql = "UPDATE forms
			SET assigned_vid = '$vid',
			    cid = '$current_cid'
			WHERE assigned_vid IS NULL";

if($db->Execute($sql))
{
    echo "success assigning vid";
}
else
{
    echo "failure assigning vid";
}


//redirect user to the verification
header("Location: quexf-1.18.1/verifyjs.php");
