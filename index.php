<?php
session_start();
if (isset($_COOKIE["userid"])){
    header ("Location: userPanel.php");
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
    <title>Users Managment</title>
</head>
<body id="mainPage">
    <?php
    if (isset($_SESSION["userAdded"]) and $_SESSION["userAdded"]==1){
        echo "<p class='confirmation'>Account created correctly!</p>";
        $_SESSION["userAdded"]=0;
    }
    if (isset($_SESSION["errorAdding"]) and $_SESSION["errorAdding"]==1){
        echo "<p class='alert'>There was an error adding the user account!</p>";
        $_SESSION["errorAdding"]=0;
    }
    if (isset($_SESSION["badCredentials"]) and $_SESSION["badCredentials"]==1){
        echo "<p class='alert'>Username or password incorrect</p>";
        $_SESSION["badCredentials"]=0;
    }
    if (isset($_SESSION["accountDeleted"]) and $_SESSION["accountDeleted"]==1){
        echo "<p class='alert'>Your account has been deleted</p>";
        $_SESSION["accountDeleted"]=0;
    }
    ?>
    <section class="mainPageContent">
        <h1>Sign in with your account</h1>
        
        <form action="db/action-signin.php" class="signForm" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" class="passwordField" required>
            <div id="togglePassword">
                <input type="checkbox" name="togglePassword" onclick="togglepasswordsignin()">
                <label for="togglePassword">Show password</label>
            </div>
            <input type="submit" class="boton">
        </form>
    <p>Don't have an account? Sign up <a href="signup.php">here</a></p>
    </section>
</body>
</html>