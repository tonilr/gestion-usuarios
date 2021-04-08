<?php
function databaseConnection(){
    //Conection to the database
    $server="localhost";
    $user="project_nascor";
    $password="zXd)JX]rMHCgNyu0";
    $bbdd="project_nascor";
    $table="users";
    //Connection
    $conn = new mysqli($server, $user, $password, $bbdd);
    //Check the connection
    if ($conn->connect_error){
        $_SESSION["connectionError"]=1;
        return;
    }else{
        return $conn;
    }
}

?>