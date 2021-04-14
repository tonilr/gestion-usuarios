<?php
session_start();
if (!isset($_SESSION["userid"])){
    header ("Location: ../index.php");
    die();
}
if(isset($_SESSION["badDeletePassword"]) and $_SESSION["badDeletePassword"]==1){
    echo "<p class='alert'>You're password is not correct<p>";
    $_SESSION["badDeletePassword"]=0;
}
if(isset($_POST["password"]) and $_POST["password"]!=NULL){
    echo $_POST["password"];
    $userid=$_SESSION["userid"];
    $pass=$_POST["password"];
    include "databaseConnection.php";
    $conn=databaseConnection();
    //Query to get the password from the user
    $sql="SELECT password FROM users where id=$userid";
    $result=$conn->query($sql);
    $data=$result->fetch_assoc();
    // echo $pass."<br>";
    // echo $data["password"]."<br>";
    //Check if the password is correct
    if(password_verify($pass,$data["password"])){
        $sql="DELETE FROM users WHERE id=$userid";
        $conn->query($sql);
        // echo "usuario borrado";
        //Delete the cookie and go back to index
        // setcookie("userid","",time()-3600,"/");
        session_destroy();
        session_start();
        $_SESSION["accountDeleted"]=1;
        if (file_exists("../img/users/$userid")){
            unlink("../img/users/$userid");
        }
        header ("Location: ../index.php");
        die();
    }else{
        //Set the session variable and reload de page
        $_SESSION["badDeletePassword"]=1;
        header ("Location: deleteAccount.php");
        die();
    }
    // echo $data["password"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="img/favicon.png" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="../css/style.css">
    <title>Delete account</title>
</head>

<body>
    <section class="mainContentAlert">
        <h1>Delete account</h1>
        <h3>Are you shure you want to delete your account? This action cannot be undone.</h3>
        <form action="deleteAccount.php" method="POST" class="signForm">
            <label for="password">Enter your password to confirm deletion</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Delete account" class="botonDelete">
        </form>
        <a href="../userPanel.php" class="boton">Go back</a>
    </section>
</body>
</html>