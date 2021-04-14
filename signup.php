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
    <script src="js/validateForm.js"></script>
    <script src="js/checkForm.js"></script>

    <title>Sign Up</title>
</head>
<body>
    <section class="mainContent">
        <h1>Create an account</h1>
        
        <form action="db/action-signup.php" method="post" class="signupForm">
            <label for="username">User Name</label>
            <input type="text" name="username" id="username" placeholder="Your username is the name that others users will see (max 20 characters)" maxlength="20" onblur=validate_username() required>
            <!-- Variable to check the validation of the username -->
            <input type="hidden" id="usernameField" value="false">
            <div id="usernameMessage" class="messageWarning"></div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Your email account" maxlength="40" onblur=validate_email() required>
            <!-- Variable to check the validation of the email -->
            <input type="hidden" id="emailField" value="false">
            <div id="emailMessage" class="messageWarning"></div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Your real name (Optional)" maxlength="20" required>
            <label for="password1">Password <img src="img/question-mark.png" id="modalButton" onclick="modal()"></label>
            <div id="myModal" class="modal">    
                <div class="modalContent"><span class="closeModal"></span><p>Minimun a lowercase letter, a capital (uppercase) letter, a number and minimun 8 characters</p></div>
            </div>
            <input type="password" name="password1" class="passwordField" id="password1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onblur=validate_password() placeholder="Create your password" required>
            <input type="hidden" id="pass1Field" value="false">
            <div id="password_warning" class="messageWarning"></div>
            <label for="password2">Confirm your password</label>
            <input type="password" name="password2" class="passwordField" id="password2" onblur=validate_password2() required>
            <input type="hidden" id="pass2Field" value="false">
            <div id="password_warning2" class="messageWarning"></div>
            <div id="togglePassword">
                <input type="checkbox" name="togglePassword" onclick="togglepasswordsignup()">
                <label for="togglePassword">Show passwords</label>
            </div>
            <input type="button" class="boton" id="sendButton" value="Send" onmouseover="checkFields()">
        </form>
        <a href="index.php" class="boton">Go back</a>
    </section>
</body>
</html>