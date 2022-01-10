<?php 
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$validate=$ejecutar->registrarCarrera($_POST["codigo_carrera"],$_POST["nombre_carrera"]);
if ($validate===2) {
    header("Location:../vista/administrador.php#carrera-container-flex");
    $_SESSION["error"]="codigo_carrera";
}
else {
    header("Location:../vista/administrador.php#carrera-container-flex");
    $_SESSION["completado"]="registro_carrera";
}
?>