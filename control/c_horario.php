<?php 
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["cedula_horario"]) && $_POST["cedula_horario"]!="") {
    $_SESSION["lista_disponibilidad"]=$ejecutar->GetDisponibilidad($_POST["cedula_horario"]);
    $_SESSION["disponibilidad_profesor"]=$ejecutar->GetAllProfesor($_POST["cedula_horario"], "cedula");
    header("Location:../vista/administrador.php#$url");
}
if (isset($_GET["cedula_horario"]) && $_GET["cedula_horario"]!="") {
    $validate=$ejecutar->FindQuery("aula","codigo", $_GET["buscar_aula"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#aula-container-grid");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="aula-container";
        header("Location:../vista/administrador.php#aula-container-grid");
     }
}
?>