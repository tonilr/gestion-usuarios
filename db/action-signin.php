<?php
session_start();
include "databaseConnection.php";
$conn=databaseConnection();
$username=$_POST["username"];
$password=(hash('sha256',$_POST["password"]));
$sql="SELECT `username`,`password`,`id` FROM `users` WHERE `username`='$username'";
$result=$conn->query($sql);
if ($result->num_rows>0){
    $data=$result->fetch_assoc();
    if ($data["password"]==$password){
        setcookie("userid",$data["id"],time()+(60*60*24*365),"/");
        header ("Location: ../");
        die();
    }else{
        $_SESSION["badCredentials"]=1;
        header ("Location: ../");
        die();
    }
}else{
    $_SESSION["badCredentials"]=1;
    header ("Location: ../");
    die();
}
?>