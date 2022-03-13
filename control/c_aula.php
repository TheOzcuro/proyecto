<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_aula"]) && $_POST["buscar_aula"]!="") {
    $validate=$ejecutar->FindQuery("aula","codigo", $_POST["buscar_aula"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="aula-container";
        header("Location:../vista/administrador.php#aula-container-grid");
     }
}
if (isset($_GET["buscar_aula"]) && $_GET["buscar_aula"]!="") {
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

else if (isset($_POST["update"]) && $_POST["update"]!=""){
    
    $dato=$ejecutar->FindQuery("aula","nombre",$_POST["nombre_aula"]);
    if ($dato[1]==$_POST["nombre_aula"] || $dato==2) {
        $validate=$ejecutar->UpdateTableAula($_POST["codigo_aula"], $_POST["nombre_aula"], $_POST["update"]);
    }
    if ($dato[1]!=$_POST["nombre_aula"] && $dato!==2) {
       $validate=3;
    }
    if ($validate===3) {
        $_SESSION["error"]="El nombre de aula que ingreso ya existe";
        $_SESSION["container"]="aula-container";
        $_SESSION["update"]=$ejecutar->FindQuery("aula","codigo", $_POST["update"]);
        header("Location:../vista/administrador.php#$url");

    }
    else if ($validate===2) {
        $_SESSION["error"]="El codigo de aula que ingreso ya existe";
        $_SESSION["container"]="aula-container";
        $_SESSION["update"]=$ejecutar->FindQuery("aula","codigo", $_POST["update"]);
        header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="aula-container";
        $_SESSION["update"]=$ejecutar->FindQuery("aula","codigo", $_POST["codigo_aula"]);
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("aula","codigo",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}
else {
    $dato=$ejecutar->FindQuery("aula","nombre",$_POST["nombre_aula"]);
    $validate=$ejecutar->registrarAula($_POST["codigo_aula"],$_POST["nombre_aula"]);
    if ($validate===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El codigo de aula que ingreso ya existe";
        
    }
    if ($dato!==3) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El nombre de aula que ingreso ya existe";
    }
    else {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="El aula se registro correctamente";
        $_SESSION["link"]="../control/c_carrera.php?buscar_aula=".$_POST["codigo_aula"];
    }
}

?>