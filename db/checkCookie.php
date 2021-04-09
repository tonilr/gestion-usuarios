<?php
// print_r($_COOKIE);
/**
 * Queremos crear un hash de nuestra contraseña uando el algoritmo DEFAULT actual.
 * Actualmente es BCRYPT, y producirá un resultado de 60 caracteres.
 *
 * Hay que tener en cuenta que DEFAULT puede cambiar con el tiempo, por lo que debería prepararse
 * para permitir que el almacenamento se amplíe a más de 60 caracteres (255 estaría bien)
 */
$hash=password_hash("123456qW", PASSWORD_DEFAULT);
echo $hash;
echo "<br>";
$verify=password_verify("98211bfd73a84917bc6e7f9c13828a04540813310f61f7861651444e1f9fa14a",$hash);
if($verify==1){
    echo "password OK";
}else{
    echo "password error";
}
?>