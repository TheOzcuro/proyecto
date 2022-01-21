<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
if (isset($_POST["buscar_materia"]) && $_POST["buscar_materia"]!="") {
    
    $validate=$ejecutar->FindQuery("materia", "codigo", $_POST["buscar_materia"]);
    if ($validate===2) {
        $_SESSION["error"]="El codigo que ingreso no existe";
        header("Location:../vista/administrador.php#materia-find-flex");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="materia-container";
        header("Location:../vista/administrador.php#materia-find-flex");
    }
}
else if (isset($_POST["update"]) && $_POST["update"]!="") {
    $validate=$ejecutar->UpdateTableMateria($_POST["codigo_materia"],$_POST["nombre_materia"],$_POST["tipo_materia"],$_POST["update"]);
    if ($validate===3) {
        $_SESSION["error"]="El nombre de materia que ingreso ya existe";
        $_SESSION["update"]=$ejecutar->FindQuery("materia", "codigo", $_POST["update"]);
        $_SESSION["container"]="materia-container";
        header("Location:../vista/administrador.php#materia-find-flex");
    }
    if ($validate===2) {
        $_SESSION["error"]="El codigo de materia que ingreso ya existe";
        $_SESSION["update"]=$ejecutar->FindQuery("materia", "codigo", $_POST["update"]);
        $_SESSION["container"]="materia-container";
        header("Location:../vista/administrador.php#materia-find-flex");
    }
    else {
        $_SESSION["update"]=$ejecutar->FindQuery("materia", "codigo", $_POST["update"]);
        $_SESSION["container"]="materia-container";
        $_SESSION["completado"]="Los datos de la materia han sido actualizados";
        header("Location:../vista/administrador.php#materia-find-flex");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!="") {
    $ejecutar->DeleteTable("materia","codigo",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados";
    header("Location:../vista/administrador.php#materia-find-flex");
}
else{
    $validate=$ejecutar->registrarMateria($_POST["codigo_materia"],$_POST["nombre_materia"],$_POST["tipo_materia"]);
    if ($validate===2) {
        header("Location:../vista/administrador.php#materia-container-flex");
        $_SESSION["error"]="El codigo de materia que ingreso ya existe";
        
    }
    if ($validate===3) {
        header("Location:../vista/administrador.php#materia-container-flex");
        $_SESSION["error"]="El nombre de materia que ingreso ya existe";
    }
    else {
        header("Location:../vista/administrador.php#materia-container-flex");
        $_SESSION["completado"]="La materia fue registrada sastifactoriamente";
    }
}

?>