<?php
session_start();
?>
<html>
<div id =sidebar class="visible">
    <?php
    include("sidebar.php");
	?>
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
            <?php include("header.php"); ?>
            <br><br><br><br><br><br><br><br><br>
            <!--header start here-->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
					<ul class="nav nav-tabs">
  						<li><a href="chart.php">Chart</a></li>
                        <li class="active"><a href="table.php">Table</a></li>
					</ul>
                    </div>
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
</body>
</html>