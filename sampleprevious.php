<?php
session_start();
include("db/dbh.php");
?>
<html>
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
<title>Sample previous work</title>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <link href="css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="page-container">
    <div class="left-content">
        <div class="mother-grid-inner">
            <!--header start here-->
            <?php //include("header.php"); ?>
            <br>
            <!--header start here-->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
					<ul class="nav nav-tabs">
  						<li class="active"><a data-toggle ="tab" href="#chart">Chart</a></li>     
                        <li><a data-toggle ="tab" href="#table">Table</a></li>
					</ul>
			<div class="tab-content">
            	<div id="chart" class="tab-pane fade in active">
                <?php

include "data.php";

?>

    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>

<?php
	$json_array = $_SESSION['json_array'];
//	echo implode("<br>",$json_array);

	for ($i=0; $i < 20; $i++) {
		$data = $json_array[$i];
//		echo $current_json;
	$question = $i+1;
	echo "Question $question:<br><br>";
//	echo $data;
	echo "<canvas id='mycanvas".$i."' style='width:400; height:400'></canvas>";
	echo "<script language='javascript'>
	
	var data = $data;
    var label = [];
    var total = [];

    for(var j in data) {
        label.push(data[j].label);
        total.push(data[j].total);
    }
var ctx = document.getElementById('mycanvas".$i."');
var mycanvas".$i." = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: label,
        datasets: [{
                label: 'Question ' + $question,
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                borderColor: ['rgba(255,99,132,1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)'],
                data: total
            }
        ]
    },
    options: {
        responsive: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }

});

	</script>";
	echo "<br><br><br><br>";
	}
?>
                </div>
                <div id="table" class="tab-pane fade in active">
<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('quexf');

$bgid;

for ($i=0; $i < 20; $i++) { 
	$bgid = $i + 1;
	$sql="SELECT label, COUNT(f.bid) AS total
	FROM boxes b LEFT JOIN formboxverifychar f ON b.bid = f.bid
	WHERE b.bgid=$bgid
	GROUP BY label
	ORDER BY b.bid";
	$records = mysql_query($sql);

	echo "Question $bgid";

	echo "<table style = 'margin:20; border:1px solid black'>";

	echo "<tr>";
		echo "<th style = 'padding:5px; border:1px solid grey'>Option</th>";
		echo "<th style = 'padding:5px; border:1px solid grey'>Total</th>";
	echo "</tr>";

	while ($quexf=mysql_fetch_assoc($records)) {
		echo "<tr>";
		echo "<td style = 'padding:5px;'>".$quexf['label']."</td>";
		echo "<td style = 'padding:5px;'>".$quexf['total']."</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
                </div>
            </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
