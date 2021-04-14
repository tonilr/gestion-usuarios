<?php
session_start();
//Check if there's no session initilized
if (!isset($_SESSION["userid"])){
    header ("Location: index.php");
    die();
}
//Some checks to show messages
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
echo "<p class='confirmation'>You're profile has been changed";
    $_SESSION["dataChanged"]=0;
}
if(isset($_SESSION["avatarMessage"]) and $_SESSION["avatarMessage"]==1){
echo "<p class='alert'>The file uploaded is not valid";
    $_SESSION["avatarMessage"]=0;
}
//Connection to the database
include "db/databaseConnection.php";
$conn=databaseConnection();
$userid=$_SESSION["userid"];
//Query to get the user information in the database
$sql="SELECT `username`,`email`,`name`,`status` FROM `users` WHERE `id`='$userid'";
$result=$conn->query($sql);
//Check if the query has a result
if ($result->num_rows>0){
    //Save the data
    $data=$result->fetch_assoc();
    //Close the connection, we don't need it anymore
    $conn->close();
    //Check if the account is suspended (status=0)
    $status=$data["status"];
    if ($status==0){
        //Delete the session to delete $_SESSION["userid]
        session_destroy();
        session_start();
        //Set the status
        $_SESSION["status"]=0;
        header ("Location: index.php");
        die();
    }
    //Save the data from database
    $username=$data["username"];
    $email=$data["email"];
    $name=$data["name"];
    //Check if the user has profile picture
    if (file_exists("img/users/$userid")){
        $userimg=$userid;
    }else{
        $userimg="000";
    }
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/javascriptFunctions.js"></script>
    <script src="js/validateProfileForm.js"></script>
    <script src="js/checkForm.js"></script>
    <title>User Panel</title>
</head>
<body id="userPanel">
    <section class="mainContent">
        <h1>User panel</h1>
        <h3 id="wellcomeMessage">Hello <?php echo $data["username"];?>!</h3>
        
        <form action="db/modifyUser.php" method="POST" class="signForm" enctype="multipart/form-data">
            <div class="avatarContainer">
                <img src="img/users/<?php echo $userimg;?>" alt="profile picture" class="userAvatar">
            </div>
            <label for="avatar">Change picture (PNG and JPG pictures. 200KB max.)</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="204800">
            <input type="file" name="avatar" id="avatar" class="inputs">
            <div id="avatarMessage" class="messageWarning"></div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php echo $email ?>" onchange="validate_email()">
            <div id="emailMessage" class="messageWarning"></div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $name ?>">
            <label for="password1">Change password <img src="img/question-mark.png" id="modalButton" onclick="modal()"></label>
            <div id="myModal" class="modal">    
                <div class="modalContent"><span class="closeModal"></span><p>Minimun a lowercase letter, a capital (uppercase) letter, a number and minimun 8 characters</p></div>
            </div>
            <input type="password" name="password1" id="password1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="passwordField" onblur="validate_password()">
            <div id="password_warning" class="messageWarning"></div>
            <input type="hidden" id="pass1Field" value="false">
            <label for="password2">Confirm new password</label>
            <input type="password" name="password2" id="password2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="passwordField" onblur="validate_password2()">
            <div id="password_warning2" class="messageWarning"></div>
            <div id="togglePassword">
                    <input type="checkbox" name="togglePassword" onclick="togglepasswordsignup()">
                    <label for="togglePassword">Show passwords</label>
            </div>
            <input type="hidden" id="pass2Field" value="false">
            <label for="actualpass">Use your password to confirm changes</label>
            <input type="password" name="actualpass" id="actualpass" required>
            <input type="submit" value="Modify profile" class="boton">
        </form>
        <form action="db/deleteAccount.php" method="POST">
            <input type="submit" value="Delete account"  class="botonDelete">
        </form>
        <form action="db/logout.php" method="POST" class="signupForm">
            <input type="submit" value="Logout" class="botonLogout">
        </form>
    </section>
</body>
</html>