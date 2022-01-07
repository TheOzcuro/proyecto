<?php 
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$ejecutar->createPassword($_SESSION["usuario_cedula"],$_POST["con"]);
$_SESSION["completado"]="pass";
header("Location: ../vista/login.php");
?>