<?php
session_start();
include "databaseConnection.php";
$conn=databaseConnection();
$username=$_POST["username"];
$password=(hash('sha256',$_POST["password"]));
$sql="SELECT `username`,`password` FROM `users` WHERE `username`='$username'";
$resultado=$conn->query($sql);
if ($resultado->num_rows>0){
    $datos=$resultado->fetch_assoc();
    if ($datos["password"]==$password){
        setcookie("username",$username,time()+(60*60*24*365),"/");
        header ("Location: ../");
    }else{
        $_SESSION["badCredentials"]=1;
        header ("Location: ../");
    }
}else{
    $_SESSION["badCredentials"]=1;
    header ("Location: ../");
}
?>