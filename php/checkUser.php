<?php
include "../db/databaseConnection.php";
// sleep(1);
$conn=databaseConnection();

if(!empty($_POST["username"])){ //Check if the username input has some text
    $username=filter_var($_POST["username"],FILTER_SANITIZE_STRING); //Save the text and send the query
    $sql="SELECT `username` FROM `users` WHERE `username`='$username'";
    $result=$conn->query($sql);
    if ($result->num_rows == 0){ //Check if we have a match with usernames 
        echo 0; //If there's no match send 0
    }else{
        echo 1; //If there is a match send 1
    }
}

//Close connection
$conn->close();
?>