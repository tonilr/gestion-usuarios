<?php
//Check if the user has a Session initialized
session_start();
if (isset($_SESSION["userid"])){
    header ("Location: userPanel.php");
    die();
}
//Check if the user wants to remember his username
if (isset($_COOKIE["username"])){
    $username=$_COOKIE["username"];
}else{
    $username="";
}
//Some checks to show messages
if (isset($_SESSION["userAdded"]) and $_SESSION["userAdded"]==1){
    echo "<p class='confirmation'>Account created correctly!</p>";
    session_destroy();
}
if (isset($_SESSION["errorAdding"]) and $_SESSION["errorAdding"]==1){
    echo "<p class='alert'>There was an error adding the user account!</p>";
    session_destroy();
}
if (isset($_SESSION["badCredentials"]) and $_SESSION["badCredentials"]==1){
    echo "<p class='alert'>Username or password incorrect</p>";
    session_destroy();
}
if (isset($_SESSION["status"]) and $_SESSION["status"]==0){
    echo "<p class='alert'>Your account has been suspended</p>";
    session_destroy();
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
    <script src="js/checkForm.js"></script>
    <title>Users Managment</title>
</head>
<body id="mainPage">
    <section class="mainContent">
        <h1>Sign in with your account</h1>
        
        <form action="db/action-signin.php" class="signForm" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo $username;?>"required>
            <div id="togglePassword">
                <input type="checkbox" name="rememberUsername">
                <label for="togglePassword">Remember username</label>
            </div>
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