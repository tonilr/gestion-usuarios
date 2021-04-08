<?php
session_start();
//Check if we have a cookie with the user id
if (!isset($_COOKIE["userid"])){
    header ("Location: index.php");
    die();
}
if (/* !isset($_POST["username"]) or $_POST["username"]==NULL or  */!isset($_POST["email"]) or $_POST["email"]==NULL or !isset($_POST["name"]) or $_POST["name"]==NULL or !isset($_POST["actualpass"]) or $_POST["actualpass"]==NULL){
    $_SESSION["fieldMissing"]=1;
    header ("Location: ../userPanel.php");
    die();
}else{
    //Database connection
    include "databaseConnection.php";
    $conn=databaseConnection();
    $userid=$_COOKIE["userid"];
    //Get the data from the user
    $sql="SELECT `id`,`username`,`email`,`name`,`password` FROM `users` WHERE `id`='$userid'";
    $result=$conn->query($sql);
    $data=$result->fetch_assoc();
    //Get the password from the database
    $savedpass=$data["password"];
    //Get the user data from the database
    $savedusername=$data["username"];
    $savedemail=$data["email"];
    $savedname=$data["name"];
    //Get the new data from the form
    // $newusername=$_POST["username"];
    $newemail=$_POST["email"];
    $newname=$_POST["name"];
    //Check if the password from the form match the password from the database
    if($savedpass!=hash("sha256",$_POST["actualpass"])){
        $_SESSION["actualpasswordError"]=1;
        // echo "password error";
        header ("Location: ../userPanel.php");
        die();
    }
    //Check if the user wants to change the password
    if (isset($_POST["newpass1"]) and $_POST["newpass1"]!=NULL and isset($_POST["newpass2"]) and $_POST["newpass2"]!=NULL){
        //Check if the new passwords match
        $newpass=hash("sha256",$_POST["newpass1"]);
        $newpass2=hash("sha256",$_POST["newpass2"]);
        if($newpass!=$newpass2){
            $_SESSION["passwordsMissmatch"]=1;
            header ("Location: ../userPanel.php");
            die();
        }else{
            //Query to update the data
            $sql="UPDATE users set `email`='$newemail',`name`='$newname',`password`='$newpass' WHERE `id`='$userid'";
            $conn->query($sql);
            // echo "Info with passwords changed";
            $_SESSION["dataChanged"]=1;
            header ("Location: ../userPanel.php");
            die();
        }
    }
    //Change the data without changing the password
    $sql="UPDATE users set `email`='$newemail',`name`='$newname' WHERE `id`='$userid'";
    $conn->query($sql);
    $_SESSION["dataChanged"]=1;
    header ("Location: ../userPanel.php");
    die();
    // echo "info changed";
}
?>