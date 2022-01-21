<?php 
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$validate=$ejecutar->registrarCarrera($_POST["codigo_carrera"],$_POST["nombre_carrera"]);
if ($validate===2) {
    header("Location:../vista/administrador.php#carrera-container-flex");
    $_SESSION["error"]="El codigo de carrera que ingreso ya existe";
}
if ($validate===3) {
    header("Location:../vista/administrador.php#carrera-container-flex");
    $_SESSION["error"]="El nombre de carrera que ingreso ya existe";
}
else {
    header("Location:../vista/administrador.php#carrera-container-flex");
    $_SESSION["completado"]="La carrera se registro correctamente";
}
?>