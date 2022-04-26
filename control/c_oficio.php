<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_oficio"]) && $_POST["buscar_oficio"]!="") {
    $validate=$ejecutar->FindQuery("noticia","codigo", $_POST["buscar_noticia"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="noticia-container";
        header("Location:../vista/administrador.php#noticia-container-grid");
     }
}
else if (isset($_GET["buscar_oficio"]) && $_GET["buscar_oficio"]!="") {
    $validate=$ejecutar->FindQuery("oficio","nombre", $_GET["buscar_oficio"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#oficio-container-grid");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="oficio-container";
        header("Location:../vista/administrador.php#oficio-container-grid");
     }
}

else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $validate=$ejecutar->UpdateTableOficio(strtoupper($_POST["oficio_registrar"]), $_POST["update"]);
    if ($validate===2) {
        $_SESSION["error"]="El nombre ".$_POST["oficio_registrar"]." de oficio ya existe";
        $_SESSION["container"]="oficio-container";
        $_SESSION["update"]=$ejecutar->FindQuery("oficio","nombre", $_POST["update"]);
        header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $ejecutar->UpdateTableProfesorInOficio(strtoupper($_POST["oficio_registrar"]), $_POST["update"]);
        $_SESSION["container"]="oficio-container";
        $_SESSION["update"]=$ejecutar->FindQuery("oficio","nombre", $_POST["oficio_registrar"]);
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("oficio","nombre",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}
else {
    $validate=$ejecutar->registrarOficio(strtoupper($_POST["oficio_registrar"]));
    if ($validate===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El nombre ".$_POST["oficio_registrar"]." de oficio ya existe";
        
    }
    else {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="El oficio se registro correctamente";
        $_SESSION["link"]="../control/c_oficio.php?buscar_oficio=".strtoupper($_POST["oficio_registrar"]);
    }
    
}

?>