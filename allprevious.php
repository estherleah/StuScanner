<?php
include 'quexf-1.18.1/functions/functions.database.php'; //session start included in here

unset($_SESSION['current_collection'])

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
    <script src="js/dropzone.js"></script>
    <link href="css/dropzone.css" rel="stylesheet" type="text/css">



    <script src="scripts/modernizr-chrg.min.js"></script>
    <script src="scripts/imagesloaded.min.js"></script>
    <script src="scripts/masonry.min.js"></script>
    <script src="scripts/chromagallery.min.js"></script>


    <title>Previous work</title>
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
                                    if($collection_arr = get_collections()) {
                                        foreach ($collection_arr as $collection) {
                                        	$cid = $collection['cid'];
                                            $label = $collection['description'];
                                            $json_array = $_SESSION['json_array'];
                                            ?>
                                            <div class="col-sm-6 col-md-6" align="center"><?php
                                            $data = $json_array[$i];
                                            echo $label;
                                            echo "<a href='sampleprevious.php?collection=$cid'><canvas id='mycanvas" . $i . "' style='width:300; height:300'></canvas></a>";
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

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>