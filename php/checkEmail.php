<?php
include "../db/databaseConnection.php";
// sleep(1);
$conn=databaseConnection();

if(!empty($_POST["email"])){
    $email=filter_Var($_POST["email"],FILTER_SANITIZE_EMAIL);
    $sql="SELECT `email` FROM `users` WHERE `email`='$email'";
    $result=$conn->query($sql);
    if ($result->num_rows == 0){ //Check if we have a match with emails 
        echo 0; //If there's no match send 0
    }else{
        echo 1; //If there is a match send 1
    }
}

//Close connection
$conn->close();
?>