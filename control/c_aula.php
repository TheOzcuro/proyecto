<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$validate=$ejecutar->registrarAula($_POST["codigo_aula"],$_POST["nombre_aula"]);
if ($validate===2) {
    header("Location:../vista/administrador.php#aula");
    $_SESSION["error"]="codigo_aula";
    
}
else {
    header("Location:../vista/administrador.php#aula");
    $_SESSION["completado"]="aula_registro";
}
?>