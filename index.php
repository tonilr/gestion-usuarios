<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/javascriptFunctions.js"></script>
    <title>Users Managment</title>
</head>
<body id="mainPage">
    <?php
    session_start();
    if (isset($_SESSION["userAdded"]) and $_SESSION["userAdded"]==1){
        echo "<p class='confirmation'>Account created correctly!</p>";
        $_SESSION["userAdded"]=0;
    }
    if (isset($_SESSION["errorAdding"]) and $_SESSION["errorAdding"]==1){
        echo "<p class='alert'>There was an error adding the user account!</p>";
        $_SESSION["errorAdding"]=0;
    }
    ?>
    <section class="mainPageContent">
        <h1>Sign in with your account</h1>
        
        <form action="db/action-signin.php" class="signForm">
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