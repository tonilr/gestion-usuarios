<?php
session_start();
if (!isset($_COOKIE["username"])){
    header ("Location: index.php");
}else{
    include "db/databaseConnection.php";
    $conn=databaseConnection();
    $username=$_COOKIE["username"];
    $sql="SELECT `username`,`email`,`name`,`status` FROM `users` WHERE `username`='$username'";
    $resultado=$conn->query($sql);
    // print_r($resultado);
    if ($resultado->num_rows>0){
        $datos=$resultado->fetch_assoc();
        // print_r($datos);
        $status=$datos["status"];
        if ($status==0){
            $_SESSION["status"]=0;
            setcookie("username","username",time()-3600,"/");
            header ("Location: index.php");
        }
        $email=$datos["email"];
        $name=$datos["name"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>User Panel</title>
</head>
<body class="userPanel">
    <h1>User panel</h1>
    <form action="db/modifyUser.php" method="POST" class="signForm">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $username ?>">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $email ?>">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo $name ?>">
        <input type="submit" value="Modify profile">
    </form>
    <form action="db/logout.php" method="POST" class="logoutForm">
        <input type="submit" value="Logout">
    </form>
</body>
</html>