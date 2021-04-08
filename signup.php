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
    <title>Sign Up</title>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION["fieldMissing"]) and $_SESSION["fieldMissing"]==1){
        echo "<p class='alert'>You must fill all the fields in the form</p>";
        $_SESSION["fieldMissing"]=0;
    }
    if (isset($_SESSION["fieldError"]) and $_SESSION["fieldError"]==1){
        echo "<p class='alert'>You have entered an invalid format in one or more fields</p>";
        $_SESSION["fieldError"]=0;
    }
    if (isset($_SESSION["passwordError"]) and $_SESSION["passwordError"]==1){
        echo "<p class='alert'>The passwords don't match</p>";
        $_SESSION["passwordError"]=0;
    }
    if (isset($_SESSION["connectionError"]) and $_SESSION["connectionError"]==1){
        echo "<p class='alert'>There was an error creating the account</p>";
        $_SESSION["connectionError"]=0;
    }
    ?>
    <section class="mainContent">
        <h1>Create an account</h1>
        
        <form action="db/action-signup.php" method="post" class="signForm">
            <label for="username">User Name</label>
            <input type="text" name="username" id="username" placeholder="Your username is the name that others users will see (max 20 characters)" maxlength="20" required>
            
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Your email account to receive notifications" maxlength="40" required>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Your real name" maxlength="20" required>
            <label for="password1">Password</label>
            <input type="password" name="password1" class="passwordField" id="password1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Minimun a lowercase letter, a capital (uppercase) letter, a number and minimun 8 characters" required>
            <label for="password2">Confirm your password</label>
            <input type="password" name="password2" class="passwordField" id="password2"  required>
            <div id="togglePassword">
                <input type="checkbox" name="togglePassword" onclick="togglepasswordsignup()">
                <label for="togglePassword">Show passwords</label>
            </div>
            <input type="submit" class="boton" value="Send">
        </form>
        <a href="index.php" class="boton">Go back</a>
    </section>
</body>
</html>