<?php 
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
if (isset($_POST["buscar_carrera"]) && $_POST["buscar_carrera"]!="") {
    $validate=$ejecutar->FindQuery("carrera","codigo", $_POST["buscar_carrera"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location: ../vista/administrador.php#carrera-find-flex");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="carrera-container";
        header("Location: ../vista/administrador.php#carrera-find-flex");
     }
}

else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $validate=$ejecutar->UpdateTableCarrera($_POST["codigo_carrera"], $_POST["nombre_carrera"], $_POST["update"]);
    
    if ($validate===3) {
        $_SESSION["error"]="El nombre de carrera que ingreso ya existe";
        $_SESSION["container"]="carrera-container";
        $_SESSION["update"]=$ejecutar->FindQuery("carrera","codigo", $_POST["update"]);
        header("Location: ../vista/administrador.php#carrera-find-flex");

    }
    if ($validate===2) {
        $_SESSION["error"]="El codigo de carrera que ingreso ya existe";
        $_SESSION["container"]="carrera-container";
        $_SESSION["update"]=$ejecutar->FindQuery("carrera","codigo", $_POST["update"]);
        header("Location: ../vista/administrador.php#carrera-find-flex");
    }
    else {
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="carrera-container";
        $_SESSION["update"]=$ejecutar->FindQuery("carrera","codigo", $_POST["codigo_carrera"]);
        header("Location: ../vista/administrador.php#carrera-find-flex");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("carrera","codigo",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location: ../vista/administrador.php#carrera-find-flex");
}
else {
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
}

?>