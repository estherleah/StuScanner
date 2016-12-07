<?php
session_start();
//include '../db/dbh.php';

   // $uid = $_POST['uid'];
   // $email = $_POST['email'];
   // $admin = $_POST['admin'];

  //TODO This requires further configuration

         $to = "willredmondson@gmail.com";
         $subject = "Admin Request OCR Student Feedback";

         $message = "<b>There has been a new admin request from email to
                      be an administrator. Press this button to accept 
                      <button>Accept</button></b>";
         $message .= "<h1>New Request.</h1>";

         $header = "From:group16 \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

         $retval = mail ($to,$subject,$message,$header);

         if( $retval == true ) {
             echo "Message sent successfully...";
         }else {
             echo "Message could not be sent...";
         }
         echo "<br><a href='../index.php'>'Return to login page</a>";
      ?>