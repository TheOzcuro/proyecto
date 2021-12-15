<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$ejecutar->setDatos($_POST["cedula"],$_POST["rol"],$_POST["primer_nombre"],$_POST["segundo_nombre"],$_POST["primer_apellido"],$_POST["segundo_apellido"],$_POST["direccion"], $_POST["telefono"]);
$validate=$ejecutar->registrarProfesor();
if ($validate===2) {
    header("Location:../vista/administrador.php#profe");
    $_SESSION["error"]="profesor_cedula";
    
}
else {
    header("Location:../vista/administrador.php#profe");
    $_SESSION["completado"]="profesor_registro";
    
}
?>