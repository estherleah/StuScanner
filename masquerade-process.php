

<?php
session_start();
include 'db/dbh.php';
?>

<div id =sidebar class="visible">
    <?php include("sidebar.php"); ?>
</div>


<script>
    $(document).ready(function() {
        var navoffeset=$(".sidebar-menu").offset().top;
        $(window).scroll(function(){
            var scrollpos=$(window).scrollTop();
            if(scrollpos >=navoffeset){
                $(".sidebar-menu").addClass("fixed");
            }else{
                $(".sidebar-menu").removeClass("fixed");
            }
        });

    });
</script>
<head>
    <title>Masquerade as other user</title>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <link href="css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="page-container">
    <div class="left-content">
        <div class="mother-grid-inner">
            <!--header start here-->
            <?php include("header.php"); ?>
            <br><br><br>
            <!--header start here-->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <?php
                        $option = isset($_POST['users']) ? $_POST['users'] : false;
                          if ($option) {
                             $sql ="SELECT * FROM users WHERE uid='$option'";
                             $result = $conn->query($sql);

                             if(!$row = $result->fetch_assoc()){
                                echo "Username and/or password incorrect";
                            } else {
                                echo "SUCCESS<br>";
                                $_SESSION["uid"] = $row["uid"];
                                echo "Masquerading as ".$_SESSION["uid"];
                            }
                        }
                        ?>
                        <form action="dashboard.php">
                            <input type="submit" value="Dashboard" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>