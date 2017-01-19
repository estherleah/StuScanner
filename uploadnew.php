<?php

/*
 *---------------------------------------------------------------
 * NEW UPLOAD PAGE
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


    <title>Upload</title>
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
                    <div class="col-sm-12">
                    <h3>Upload</h3>
                    <div id="align" align="center">
                        <!--Script for tooltip-->
                        <script>
                            $(document).ready(function(){
                                $('[data-toggle="tooltip"]').tooltip('show');
                            });
                        </script>

                        <h5>This only works when each pdf contains a single questionnaire. Please split the pdf before upload. This can be done online <a href="https://www.sejda.com/split-pdf" target="_blank">here</a>.</h5>
                        <br>

                        
                        <div class="col-sm-6">
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <h3 style="margin-bottom: 20px">Create new form collection<a style="color: #53575e;" href="#" class="tip" data-toggle="tooltip" title="A collection is a group of forms for a class"><sup>?</sup></a></h3>
                                <p>Collection name:</p>
                                <input type="text" name="description" style="height: 30px" />
                                <br>
                                <input style="margin-left: 75px" type="file" name="fileList[]" value="fileList" id="fileList" multiple />
                                <button type="submit" style="padding: 5px">Create new form collection</button>
                            </form>
                        </div>

                        <div class="col-sm-6">
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <h3 style="margin-bottom: 20px">Add form to an existing collection<a style="color: #53575e;" href="#" class="tip" data-toggle="tooltip" title="A collection is a group of forms for a class"><sup>?</sup></a></h3>
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
                                        <option name="description" value=<?php echo($collection['cid']);?>><?php echo($collection['description']);?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                <input style="margin-left: 75px" type="file" name="fileList[]" value="fileList" id="fileList" multiple />
                                <button type="submit" style="padding: 5px">Add Files</button>
                            </form>
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