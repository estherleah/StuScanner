<?php

/*
 *---------------------------------------------------------------
 * MASQUERADE PAGE
 *---------------------------------------------------------------
 *
 * @WE
 */

session_start();
include 'db/dbh.php';

?>
<div id =sidebar class="visible">
    <link rel="icon" type="image/png" href="img/ucl-icon.gif" />
    <?php include("sidebar.php"); ?>
</div>

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
            <?php include("header.php"); ?>
            <br><br><br>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <?php

                        //get all users from the database
                        $sql ="SELECT uid FROM users";
                        $result = $conn->query($sql);


                        ?>

                        <form action="masquerade-process.php" method="POST" style="color:#65bdff; width:500px; margin-top: 16px;">
                          <p>Which User?
                            <select name="users" onchange="this.form.submit()">
                              <option value="" >--Select--</option>
                              <?php
                              //insert users into a select combo box
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

