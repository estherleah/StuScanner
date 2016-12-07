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

                        $sql ="SELECT uid FROM users";
                        $result = $conn->query($sql);


                        ?>

                        <form action="masquerade-process.php" method="POST" style="color:#65bdff; width:500px; margin-top: 16px;">
                          <p>Which User?
                            <select name="users" onchange="this.form.submit()">
                              <option value="" >--Select--</option>
                              <?php
                                while($row = $result->fetch_assoc() or die (mysql_error()))
                                {
                              ?>
                              <option value=<?php echo($row['uid']);?>><?php echo($row['uid']);?></option>
                              <?php
                                }
                              ?>
                            </select>
                          </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

