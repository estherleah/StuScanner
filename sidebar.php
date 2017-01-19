<?php
/*
 *---------------------------------------------------------------
 * SIDEBAR
 *---------------------------------------------------------------
 *
 *
 * @HZ
 */
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"></script>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="js/jquery-3.1.1.min.js"></script>
</head>
<body>

<div id="sidebar" class="sidebar-menu" style="position: fixed">
    <div id class="menu">
        <ul id="menu">
        
            <li id="menu--comunicacao"><a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>

			<li id="menu--comunicacao"><a href="allprevious.php"><i class="fa fa-pie-chart"></i><span>Previous work</span></a>
                <!--<ul id="menu-academico-sub">
                    <li id="menu-arquivos"><a href="allprevious.php"><i class="fa fa-pie-chart"></i>Previous charts</a></li>
                </ul>-->
            </li>
            
            <li  id="menu--comunicacao"><a href="uploadnew.php"><i class="fa fa-upload"></i><span>Upload</span></a></li>
            
            <li id="menu--comunicacao"><a href="#"><i class="fa fa-user nav_icon"></i><span>My Account</span><span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-comunicacao-sub">
                    <li id="menu-arquivos"><a href="changepassword.php"><i class="fa fa-refresh"></i>Change password</a></li>
                    <!--<li id="menu-arquivos"><a href="manage.php"><i class="fa fa-table"></i>Manage</a></li>-->
                    <li id="menu-arquivos"><a href="includes/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
                </ul>
            </li>

            <?php
            if(isset($_SESSION['admin'])) {
                if ($_SESSION['admin'] == 1) { ?>
                    <li id="menu--comunicacao"><a href="#"><i class="fa fa-user-plus"></i><span>Administrator</span><span
                                    class="fa fa-angle-right" style="float: right"></span></a>
                        <ul id="menu-academico-sub">
                            <li id="menu-arquivos"><a href="masquerade.php"><i class="fa fa-user-plus"></i>View all users</a></li>
                            <li id="menu-arquivos"><a href="quexf-1.18.1/admin/index.php"><i class="fa fa-cogs"></i>Backend</a></li>
                            <li id="menu-arquivos"><a href="includes/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                <?php }
            }?>
        </ul>
    </div>
</div>

</body>