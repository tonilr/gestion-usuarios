<?php
setcookie("userid","",time()-3600,"/");
session_start();
session_destroy();
header ("Location: ../index.php");
die();
?>