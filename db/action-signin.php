<?php
session_start();
include "databaseConnection.php";
$conn=databaseConnection();
//Filter and save the data given by the user
$username=filter_var($_POST["username"],FILTER_SANITIZE_STRING);
$password=$_POST["password"];
//Query to get the data on database
$sql="SELECT `username`,`password`,`id` FROM `users` WHERE `username`='$username'";
$result=$conn->query($sql);
if ($result->num_rows>0){
    $data=$result->fetch_assoc();
    //Check password and username with the database
    if (password_verify($password,$data["password"]) and $username==$data["username"]){
        //Save the user id to the session
        $_SESSION["userid"]=$data["id"];
        if (isset($_POST["rememberUsername"])){
            //Save the username if the user wants to remember it
            setcookie("username",$data["username"],time()+(60*60*24*365),"/");
        }else{
            //Delete the cookie if the user doesn't want to remember it 
            setcookie("username","",time()-3600,"/");
        }
        header ("Location: ../");
        die();
    }else{
        //If username or password are wrong
        $_SESSION["badCredentials"]=1;
        header ("Location: ../");
        die();
    }
}else{
    //If the query doesn't get any results
    $_SESSION["badCredentials"]=1;
    header ("Location: ../");
    die();
}
?>