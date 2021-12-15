<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$validate=$ejecutar->ValidateLogin($_POST["usuario"]);
    if ($validate===true) {
        $_SESSION["usuario"]="true";
        header("Location: ../vista/administrador.php");
    }
    if ($validate===2) {
        $_SESSION["error"]="usuario_no_administrador";
        header("Location: ../vista/login.php");
    }
    if ($validate===false) {
        $_SESSION["error"]="usuario_no_existe";
        header("Location: ../vista/login.php");
    }
?>