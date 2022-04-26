<?php 
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
if ($_SESSION["usuario_temp"]=="profesor") {
    echo $ejecutar->createPasswordProfesor($_SESSION["usuario_cedula"],$_POST["con"]);
}
else {
    $ejecutar->createPassword($_SESSION["usuario_cedula"],$_POST["con"]);
}
$_SESSION["completado"]="Se cambio la contraseña correctamente";
unset($_SESSION["usuario_temp"]);
header("Location: ../vista/login.php");
?>