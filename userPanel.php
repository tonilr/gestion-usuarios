<?php
session_start();
if (!isset($_COOKIE["userid"])){
    header ("Location: index.php");
    die();
}
if(isset($_SESSION["actualpasswordError"]) and $_SESSION["actualpasswordError"]==1){
    echo "<p class='alert'>Your password is not correct";
    $_SESSION["actualpasswordError"]=0;
}
if(isset($_SESSION["passwordsMissmatch"]) and $_SESSION["passwordsMissmatch"]==1){
    echo "<p class='alert'>Your new passwords do not match";
    $_SESSION["passwordsMissmatch"]=0;
}
if(isset($_SESSION["fieldMissing"]) and $_SESSION["fieldMissing"]==1){
    echo "<p class='alert'>You have to fill all the data";
    $_SESSION["fieldMissing"]=0;
}
if(isset($_SESSION["dataChanged"]) and $_SESSION["dataChanged"]==1){
echo "<p class='confirmation'>You're data has been changed";
    $_SESSION["dataChanged"]=0;
}
include "db/databaseConnection.php";
$conn=databaseConnection();
$userid=$_COOKIE["userid"];
$sql="SELECT `username`,`email`,`name`,`status` FROM `users` WHERE `id`='$userid'";
$result=$conn->query($sql);
// print_r($resultado);
if ($result->num_rows>0){
    $data=$result->fetch_assoc();
    $conn->close();
    // print_r($datos);
    $status=$data["status"];
    if ($status==0){
        $_SESSION["status"]=0;
        setcookie("userid","",time()-3600,"/");
        session_destroy();
        header ("Location: index.php");
        die();
    }
    $username=$data["username"];
    $email=$data["email"];
    $name=$data["name"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/favicon.png" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="js/javascriptFunctions.js"></script>
    <title>User Panel</title>
</head>
<body class="userPanel">
    <h1>User panel</h1>
    <h3><?php echo $data["username"];?></h3>
    <form action="db/modifyUser.php" method="POST" class="signForm">
        <!-- <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $username ?>"> -->
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $email ?>">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo $name ?>">
        <label for="newpass1">Change password: Minimun a lowercase letter, a capital (uppercase) letter, a number and minimun 8 characters</label>
        <input type="password" name="newpass1" id="newpass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="passwordField">
        <label for="newpass2">Confirm new password</label>
        <input type="password" name="newpass2" id="newpass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="passwordField">
        <div id="togglePassword">
                <input type="checkbox" name="togglePassword" onclick="togglepasswordsignup()">
                <label for="togglePassword">Show passwords</label>
        </div>
        <label for="actualpass">Use your password to confirm changes</label>
        <input type="password" name="actualpass" id="actualpass" required>
        <input type="submit" value="Modify profile" class="boton">
    </form>
    <form action="db/deleteAccount.php" method="POST">
        <input type="submit" value="Delete account"  class="botonDelete">
    </form>
    <form action="db/logout.php" method="POST" class="logoutForm">
        <input type="submit" value="Logout">
    </form>
</body>
</html>