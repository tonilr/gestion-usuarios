<?php
setcookie("username","username",time()-3600,"/");
header ("Location: ../index.php");
?>