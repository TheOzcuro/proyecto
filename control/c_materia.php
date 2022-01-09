<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$validate=$ejecutar->registrarMateria($_POST["codigo_materia"],$_POST["nombre_materia"],$_POST["tipo_materia"]);
if ($validate===2) {
    header("Location:../vista/administrador.php#materia-container-flex");
    $_SESSION["error"]="codigo_materia";
    
}
else {
    header("Location:../vista/administrador.php#materia-container-flex");
    $_SESSION["completado"]="registro_materia";
}
?>