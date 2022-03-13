<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_materia"]) && $_POST["buscar_materia"]!="") {
    
    $validate=$ejecutar->FindQuery("materia", "codigo", $_POST["buscar_materia"]);
    if ($validate===2) {
        $_SESSION["error"]="El codigo que ingreso no existe";
        header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="materia-container";
        header("Location:../vista/administrador.php#$url");
    }
}
if (isset($_GET["buscar_materia"]) && $_GET["buscar_materia"]!="") {
    
    $validate=$ejecutar->FindQuery("materia", "codigo", $_GET["buscar_materia"]);
    if ($validate===2) {
        $_SESSION["error"]="El codigo que ingreso no existe";
        header("Location:../vista/administrador.php#materia-container-grid");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="materia-container";
        header("Location:../vista/administrador.php#materia-container-grid");
    }
}
else if (isset($_POST["update"]) && $_POST["update"]!="") {
    $dato=$ejecutar->FindQuery("materia","nombre",$_POST["nombre_materia"]);
    if ($dato[1]==$_POST["nombre_materia"] || $dato==2) {
        $validate=$ejecutar->UpdateTableMateria($_POST["codigo_materia"],$_POST["nombre_materia"],$_POST["tipo_materia"],$_POST["update"]);
    }
    if ($dato[1]!=$_POST["nombre_materia"] && $dato!==2) {
       $validate=3;
    }
    if ($validate===3) {
        $_SESSION["error"]="El nombre de materia que ingreso ya existe";
        $_SESSION["update"]=$ejecutar->FindQuery("materia", "codigo", $_POST["update"]);
        $_SESSION["container"]="materia-container";
        header("Location:../vista/administrador.php#$url");
    }
    else if ($validate===2) {
        $_SESSION["error"]="El codigo de materia que ingreso ya existe";
        $_SESSION["update"]=$ejecutar->FindQuery("materia", "codigo", $_POST["update"]);
        $_SESSION["container"]="materia-container";
        header("Location:../vista/administrador.php#$url");
    }
    else {
        if ($_POST["codigo_materia"]!=$_POST["update"]) {
            $ejecutar->UpdateTableMateriasPensum($_POST["update"],$_POST["codigo_materia"]);
        }
        $_SESSION["update"]=$ejecutar->FindQuery("materia", "codigo", $_POST["codigo_materia"]);
        $_SESSION["container"]="materia-container";
        $_SESSION["completado"]="Los datos de la materia han sido actualizados";
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!="") {
    $ejecutar->DeleteTable("pensum","unidad_curricular",$_POST["delete"]);
    $ejecutar->DeleteTable("materia","codigo",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados";
    header("Location:../vista/administrador.php#$url");
}
else{
    $dato=$ejecutar->FindQuery("materia","nombre",$_POST["nombre_materia"]);
    $validate=$ejecutar->registrarMateria($_POST["codigo_materia"],$_POST["nombre_materia"],$_POST["tipo_materia"]);
    if ($validate===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El codigo de materia que ingreso ya existe";
        
    }
    else if ($dato!==2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El nombre de materia que ingreso ya existe";
    }
    else {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="La materia fue registrada sastifactoriamente";
        $_SESSION["link"]="../control/c_materia.php?buscar_materia=".$_POST["codigo_materia"];
    }
}

?>