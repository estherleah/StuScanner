<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>change password</title>
    <style type="text/css">
        form{
            text-align: center;
        }
    </style>
</head>
<body>
<?php
session_start();
?>
<form  action="includes/alterpassword.php" method="post" onsubmit="return alter()">
    Username: <input type="text" name="username" id ="username" /><br/>
    Original password: <input type="password" name="oldpassword" id ="oldpassword"/><br/>
    New password: <input type="password" name="newpassword" id="newpassword"/><br/>
	Confirm new password: <input type="password" name="assertpassword" id="assertpassword"/><br/>
    <input type="submit" value="Change password" onclick="return alter()">
    <p><a href="dashboard.php">Back</a></p>
</form>
<script type="text/javascript">
    document.getElementById("username").value="<?php echo "${_SESSION["uid"]}";?>"
</script>

<script type="text/javascript">
    function alter() {

        var username=document.getElementById("username").value;
        var oldpassword=document.getElementById("oldpassword").value;
        var newpassword=document.getElementById("newpassword").value;
        var assertpassword=document.getElementById("assertpassword").value;
        var regex=/^[/s]+$/;
        if(regex.test(username)||username.length==0){
            alert("The username is not in the correct format");
            return false;
        }
        if(regex.test(oldpassword)||oldpassword.length==0){
            alert("The original password is not in the correct format");
            return false;
        }
        if(regex.test(newpassword)||newpassword.length==0) {
            alert("The new password is not in the correct format");
            return false;
        }
        if (assertpassword != newpassword||assertpassword==0) {
            alert("Two password entries are inconsistent");
            return false;
        }
        return true;

    }
</script>
</body>
</html>