<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_noticia"]) && $_POST["buscar_noticia"]!="") {
    $validate=$ejecutar->FindQuery("noticia","codigo", $_POST["buscar_noticia"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       if ($_SESSION["usuario"]=="profesor") {
        header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#noticia-container-grid");
        }
        else {
            header("Location:../vista/administrador.php#noticia-container-grid");
        }
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="noticia-container";
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#noticia-container-grid");
        }
        else {
            header("Location:../vista/administrador.php#noticia-container-grid");
        }
     }
}
else if (isset($_GET["buscar_noticia"]) && $_GET["buscar_noticia"]!="") {
    $validate=$ejecutar->FindQuery("noticia","codigo", $_GET["buscar_noticia"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       if ($_SESSION["usuario"]=="profesor") {
        header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="noticia-container";
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
     }
}

else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $date = date('y-m-d');
    $validate=$ejecutar->UpdateTableNoticia(strtoupper($_POST["codigo_noticia"]), strtoupper($_POST["descripcion"]),$date,$_POST["fecha_expiracion"],$_POST["update"]);
    if ($validate===2) {
        $_SESSION["error"]="El codigo de la noticia que ingreso ya existe";
        $_SESSION["container"]="noticia-container";
        $_SESSION["update"]=$ejecutar->FindQuery("noticia","codigo", $_POST["update"]);
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
    }
    else {
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="noticia-container";
        $_SESSION["update"]=$ejecutar->FindQuery("noticia","codigo", $_POST["codigo_noticia"]);
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("noticia","codigo",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    if ($_SESSION["usuario"]=="profesor") {
        header("Location:../vista/profesor.php#$url");
    }
    else if($_SESSION["usuario"]=="administrador"){
        header("Location:../vista/coordinador.php#$url");
    }
    else {
        header("Location:../vista/administrador.php#$url");
    }
}
else {
    $date = date('y-m-d');
    $validate=$ejecutar->registraNoticia(strtoupper($_POST["codigo_noticia"]),strtoupper($_POST["descripcion"]),$date,$_POST["fecha_expiracion"]);
    
    if ($validate===2) {
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
        $_SESSION["error"]="El codigo ".$_POST["codigo_noticia"]." de la noticia ya existe";
        
    }
    else {
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
        $_SESSION["completado"]="La noticia se registro correctamente";
        $_SESSION["link"]="../control/c_noticia.php?buscar_noticia=".strtoupper($_POST["codigo_noticia"]);
    }
    
}

?>