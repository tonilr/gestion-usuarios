<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Users Managment</title>
</head>
<body>
    <section class="mainContent">
        <h1>Sing in with your account</h1>
        <?php
        session_start();
        if (isset($_SESSION["fieldMissing"]) and $_SESSION["fieldMissing"]==1){
            echo "<p class='alert'>You must fill all the fields in the form</p>";
            $_SESSION["fieldsMissing"]=0;
        }
        if (isset($_SESSION["fieldsError"]) and $_SESSION["fieldsError"]==1){
            echo "<p class='alert'>You have entered an invalid format in one field</p>";
            $_SESSION["fieldsError"]=0;
        }
        if (isset($_SESSION["userAdded"]) and $_SESSION["userAdded"]==1){
            echo "<p class='alert'>User added correctly!</p>";
            $_SESSION["userAdded"]=0;
        }
        ?>
        <form action="db/action-signin.php" class="signForm">
            <label for="username">Username
                <input type="text" name="username" id="username">
            </label>
            <label for="password">Password
                <input type="text" name="password" id="password">
            </label>
            <input type="submit" class="boton">
        </form>
    <p>Don't have an account? Sign up <a href="signup.php">here</a></p>
    </section>

</body>
</html>