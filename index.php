<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <link href="css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/bootstrap.fix.js"></script>
<title>Login</title>
</head>
<body>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-xs-6 span9">
            <div class="carousel slide" id="carousel-685276">
                <ol class="carousel-indicators">
                    <li data-slide-to="0" data-target="#carousel-685276">
                    </li>
                    <li data-slide-to="1" data-target="#carousel-685276">
                    </li>
                    <li data-slide-to="2" data-target="#carousel-685276" class="active">
                    </li>
                </ol>
                <div class="carousel-inner">
                    <div class="item">
                        <img alt="here is picture 1" src="img/loginucl1.png" width="1356" height="850" />
                        <div class="carousel-caption">
                            <p>
                                ATG Class Student OCR Feedback Scanning App
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="here is picture 2" src="img/loginucl2.png" width="1356" height="850" />
                        <div class="carousel-caption">
                            <p>
                                ATG Class Student OCR Feedback Scanning App
                            </p>
                        </div>
                    </div>
                    <div class="item active">
                        <img alt="here is picture 3" src="img/loginucl3.png" width="1356" height="850" />
                        <div class="carousel-caption">
                            <p>
                                ATG Class Student OCR Feedback Scanning App
                            </p>
                        </div>
                    </div>
                </div> <a data-slide="prev" href="#carousel-685276" class="left carousel-control">‹</a> <a data-slide="next" href="#carousel-685276" class="right carousel-control">›</a>
            </div>
        </div>
        <div class="col-xs-6 span3">
            <img alt="ATG Class Student OCR Feedback Scanning App" src="img/test1.png" />
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <form action="includes/loginverify.php" method="post">
                <div class="control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls">
                        <input id="username" type="text" name="uid" placeholder="Username"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Password</label>
                    <div class="controls">
                        <input id="inputPassword" type="password" name="pwd" placeholder="Password"/><br>
                        <?php
                        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                        if (strpos($url,'error=incorrect') !==false){
                            echo "Your username or password is incorrect!";
                        }?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <label class="checkbox"><input type="checkbox" />Remember me</label><button class="btn" type="submit">Login</button>
                        <br><br>
                        <p>Not registered yet? Sign up now!</p>
                    </div>
                </div>
            </form>
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Sign up
            </button>
            <!-- （Modal） -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">
                            </button>
                            <?php
                            $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                            if (strpos($url,'error=empty') !==false){
                                ?>
                                <script>
                                    $(function () { $('#myModal').modal({
                                        keyboard: true
                                    })});
                                </script>
                                <h4 class="modal-title" id="myModalLabel">
                                    <style>
                                    </style>
                                    Fill out all fields!
                                </h4>
                                <?php ;} ?>
                        </div>
                        <div class="modal-body">
                            <form action="includes/signup.php" method="POST">
                                <input type="text" name="uid" placeholder="Username"><br>
                                <input type="text" name="email" placeholder="Email"><br>
                                <input type="password" name="pwd" placeholder="Password"><br>
                                <input type="password" name="pwd2" placeholder="Confirm Password"><br>
                                <a href="includes/adminrequest.php">Request Administrator Access</a><br><br><br>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-primary">Sign up</button>

                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>
        </div>
    </div>
</div>

<?php
//$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//if (strpos($url,'error=empty') !==false){
//}
//else if (strpos($url,'error=username') !==false){
//   echo "Username already exists!";
//}
//else if (strpos($url,'error=notsame') !==false){
//   echo "You have entered different password !";
//}


?>

</body>

</html>
