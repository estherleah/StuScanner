<?php
/*
*---------------------------------------------------------------
* HEADER
*---------------------------------------------------------------
*
*
* @HZ
*/
?>
<head>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <link href="css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
</head>
<body>
<div class="page-container">
        <div class="mother-grid-inner">
            <!--header start here-->
            <div class="header-main">
                <div class="header-left">
                    <div class="logo-name">
                        <a alt="UStuScan Logo" href="dashboard.php"><img src="img/logo.png" height="95" width="282" /></a>
                    </div>

                    <div class="clearfix" > </div>
                </div>
                <div class="header-right">
                    <div class="clearfix">
                        <p style="color:#65bdff; font-size:20px; font-weight:bold; text-align:right; margin-top:5px;
								   margin-right: 50px;">Welcome, <?php
                            if (isset($_SESSION['uid'])){
                                echo $_SESSION['uid'];
                            } else {
                                echo "User ". $_SESSION['vid'];
                            }?>! </i> </p>
                    </div>
                    <div class="clearfix">
                        <p style="color:#65bdff; font-size:15px; text-align:right; margin-top:20px; margin-right:50px;">
                        	<a href="includes/logout.php">Log out</a>
                        </p>
                    </div>

                </div>
                <div class="clearfix"> </div>
            </div>

            <!--heder end here-->

            <!-- script-for sticky-nav -->
