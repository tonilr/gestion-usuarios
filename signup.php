<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign Up</title>
</head>
<body>
    <section class="mainContent">
        <h1>Create an account</h1>
        <?php
        session_start();
        if (isset($_SESSION["fieldMissing"]) and $_SESSION["fieldMissing"]==1){
            echo "<p class='alert'>You must fill all the fields in the form</p>";
            $_SESSION["fieldMissing"]=0;
        }
        if (isset($_SESSION["fieldsError"]) and $_SESSION["fieldsError"]==1){
            echo "<p class='alert'>You have entered an invalid format in one field</p>";
            $_SESSION["fieldsError"]=0;
        }
        if (isset($_SESSION["userAdded"]) and $_SESSION["userAdded"]==1){
            echo "<p class='alert'>Account created correctly!</p>";
            $_SESSION["userAdded"]=0;
        }
        if (isset($_SESSION["errorAdding"]) and $_SESSION["errorAdding"]==1){
            echo "<p class='alert'>There was an error adding the user account!</p>";
            $_SESSION["errorAdding"]=0;
        }
        ?>
        <form action="db/action-signup.php" method="post" class="signupForm">
            <label for="username">User Name
                <input type="text" name="username" id="username">
            </label>
            <label for="email">Email
                <input type="text" name="email" id="email">
            </label>
            <label for="name">Name
                <input type="text" name="name" id="name">
            </label>
            <label for="password">Password
                <input type="password" name="password" id="password">
            </label>
            <input type="submit" class="boton">
        </form>
    </section>
</body>
</html>