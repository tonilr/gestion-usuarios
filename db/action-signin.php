<?php
session_start();
include "databaseConnection.php";
$conn=databaseConnection();
$username=filter_var($_POST["username"],FILTER_SANITIZE_STRING);
$password=$_POST["password"];
$sql="SELECT `username`,`password`,`id` FROM `users` WHERE `username`='$username'";
$result=$conn->query($sql);
if ($result->num_rows>0){
    $data=$result->fetch_assoc();
    if (password_verify($password,$data["password"]) and $username==$data["username"]){
        //setcookie("userid",$data["id"],time()+(60*60*24*365),"/");
        $_SESSION["userid"]=$data["id"];
        if (isset($_POST["rememberUsername"])){
            setcookie("username",$data["username"],time()+(60*60*24*365),"/");
        }else{
            setcookie("username","",time()-3600,"/");
        }
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