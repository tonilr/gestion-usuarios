<?php
session_start();
//Check if all the fields are set
if (!isset($_POST["username"]) or $_POST["username"]==NULL or !isset($_POST["email"]) or $_POST["email"]==NULL or !isset($_POST["name"]) or $_POST["name"]==NULL or !isset($_POST["password1"]) or $_POST["password1"]==NULL or !isset($_POST["password2"]) or $_POST["password2"]==NULL){
    $_SESSION["fieldMissing"]=1;
    header ("Location: ../signup.php");
    die();
}else{
    $username=filter_var($_POST["username"],FILTER_SANITIZE_STRING);
    $email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
    $email=filter_var($email,FILTER_SANITIZE_STRING);
    $name=filter_var($_POST["name"],FILTER_SANITIZE_STRING);
    $userpassword=hash('sha256',$_POST["password1"]);
    $userpassword2=hash('sha256',$_POST["password2"]);
//Check the passwords
if ($userpassword!=$userpassword2){
    $_SESSION["passwordError"]=1;
    header ("Location: ../signup.php");
    die();
}
//Check if one of the fields is not valid
if($username!=$_POST["username"] or $email!=$_POST["email"] or $name!=$_POST["name"]){
    $_SESSION["fieldError"]=1;
    header ("Location: ../signup.php");
    die();
}else{
    include "databaseConnection.php";
    $conn=databaseConnection();
    if ($_SESSION["connectionError"]==1){
        header ("Location: ../signup.php");
        die();
    }
    $userpassword=password_hash($_POST["password1"],PASSWORD_DEFAULT);
    //Query
    $sql="INSERT INTO users VALUES(NULL, '$username', '$email', '$name', '$userpassword', 1, current_timestamp())";
    //Query to insert new user
    if ($conn->query($sql)){
        $conn->close();
        $_SESSION["userAdded"]=1;
        $_SESSION["errorAdding"]=0;
        header ("Location: ../");
        die();
    }else{
        $conn->close();
        $_SESSION["errorAdding"]=1;
        $_SESSION["userAdded"]=0;
        header ("Location: ../signup.php");
        die();
    }
}
}
?>