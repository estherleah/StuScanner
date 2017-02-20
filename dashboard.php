<?php

/*
 *---------------------------------------------------------------
 * DASHBOARD PAGE
 *---------------------------------------------------------------
 *
 *
 * @ELM
 */

include 'quexf-1.18.1/functions/functions.database.php'; //session start included in here
unset($_SESSION['current_collection']);

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
    <link rel="icon" type="image/png" href="img/ucl-icon.gif" />
    <script type="text/javascript" src="js/bootstrap.min.js"></script>



    <script src="scripts/modernizr-chrg.min.js"></script>
    <script src="scripts/imagesloaded.min.js"></script>
    <script src="scripts/masonry.min.js"></script>
    <script src="scripts/chromagallery.min.js"></script>


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
                    <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <?php if(!isset($_SESSION['vid'])){
                            echo "<h3>Please log in <a href='index.php'>here</a></h3>";
                        } else { ?>
                            <h3 class="text-left">Previous work</h3>
                            <div class="row-fluid">
                                <div class="row-fluid">
                                <br><br><br><br>
                                    <?php include("data.php");?>
                                <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
                                <script type="text/javascript" src="js/Chart.min.js"></script>
                                    <?php
                                    $i = 0;
                                    if($collection_arr = get_last_collections()) {
                                        foreach ($collection_arr as $collection) {
                                        	$cid = $collection['cid'];
                                            $label = $collection['description'];
                                            $json_array = $_SESSION['json_array'];
                                            ?>
                                            <div class="col-sm-8 col-md-6" align="center"><?php
                                            $data = $json_array[$i];
                                            echo $label;
                                            echo "<a href='sampleprevious.php?collection=$cid'><canvas id='mycanvas" . $i . "' style='width:200; height:200'></canvas></a>";
                                            echo "<script language='javascript'>
                        
                                        var data = $data;
                                        var label = [];
                                        var total = [];
                                    
                                        for(var j in data) {
                                            label.push(data[j].label);
                                            total.push(data[j].total);
                                        }
                                        var ctx = document.getElementById('mycanvas" . $i . "');
                                        var mycanvas" . $i . " = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: label,
                                            datasets: [{
                                                     backgroundColor: ['rgba(255, 0, 0, 0.2)', 'rgba(255, 110, 0, 0.2)', 'rgba(255, 225, 0, 0.2)', 'rgba(100, 200, 35, 0.2)', 'rgba(50, 185, 255, 0.2)', 'rgba(200, 75, 255, 0.2)'],
                                                     borderColor: ['rgba(255, 0, 0, 1)', 'rgba(255, 110, 0, 1)', 'rgba(255, 225, 0, 1)', 'rgba(100, 200, 35, 1)', 'rgba(50, 185, 255, 1)', 'rgba(200, 75, 255, 1)'],
                                                    borderWidth: 1,
                                                    data: total
                                                            }
                                                        ]
                                                    },
                                                    options: {
						                                responsive: false,
														legend: {
						            						display: false,
        												},
														tooltips: {
                											enabled: false,
            											}
                            						}
                            						});
                                                    </script>";
                                            ?><br><br><br></div><?php
                                            $i++;
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        <?php } ?>
                        <div id="align" align="center">
                            <br>
                            <p><a href="allprevious.php">View all previous work</a></p>
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-5 col-lg-5">
                        <h3>Upload</h3>
                        <br><br><br>

                        <h5>This only works when each pdf contains a single questionnaire. Please split the pdf before upload.<br>
                            This can be done online <a href="https://www.sejda.com/split-pdf" target="_blank">here</a>.</h5>
                        <br>

                        <!--Script for tooltip-->
                        <script>
                            $(document).ready(function(){
                                $('[data-toggle="tooltip"]').tooltip();
                            });
                        </script>

                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <h4 style="margin-bottom: 20px">Create new form collection<a style="color: #53575e;" href="#" data-toggle="tooltip" title="A collection is a group of forms for a class"><sup>?</sup></a></h4>
                            <p>Collection name:</p>
                            <input type="text" name="description" style="height: 30px" />
                            <br>
                            <input type="file" name="fileList[]" value="fileList" id="fileList" multiple />
                            <button type="submit" style="padding: 5px">Create new form collection</button>
                        </form>

                        <br><br><br>

                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <h4 style="margin-bottom: 20px">Add form to an existing collection<a href="#" style="color: #53575e" data-toggle="tooltip" data-placement="top" title="A collection is a group of forms for a class"><sup>?</sup></a></h4>
                            <p>Which collection would you like to add files to?</p>
                            <select name="collection">
                                <option value="" >--Select--</option>
                                <?php
                                $cid_arr = get_collections();
                                foreach( $cid_arr as $cid){
                                    echo $cid['cid'];
                                }
                                foreach ($cid_arr as $collection)
                                {
                                    ?>
                                    <option value=<?php echo($collection['cid']);?>><?php echo($collection['description']);?></option>
                                    <?php
                                    echo $_POST['collection'];
                                }
                                ?>
                            </select>
                            <br>
                            <input type="file" name="fileList[]" value="fileList" id="fileList" multiple />
                            <button type="submit" style="padding: 5px">Add Files</button>
                        </form>




                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
