<?php

/*
 *---------------------------------------------------------------
 * MANAGE
 *---------------------------------------------------------------
 *
 *
 * @HZ
 */

session_start();
?>
<html>
<link rel="icon" type="image/png" href="img/ucl-icon.gif" />
<div id =sidebar class="visible">
    <?php include("sidebar.php"); ?>
</div>


<head>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <link href="css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
    <meta charset="UTF-8">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="js/dropzone.js"></script>
    <link href="css/dropzone.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/dropzone.css" />

    <title>Dashboard</title>
</head>
<body>
<div class="page-container">
    <div class="left-content">
        <div class="mother-grid-inner">
            <!--header start here-->
            <?php include("header.php"); ?>


            <br><br><br>

            <div class="container-fluid">

                <div class="row-fluid">
                    <div class="span10" id="span10">


                        <br><h3 class="text-left">My file management</h3><br><br>
                        <br><br>
                        <form action="parser.php" class="dropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>


                        <p><a href="view_upload.php">View Upload</a> </p>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html