<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_seccion"]) && $_POST["buscar_seccion"]!="") {
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
else if (isset($_GET["buscar_seccion"]) && $_GET["buscar_seccion"]!="") {
    $validate=$ejecutar->FindQuery("seccion","codigo", $_GET["buscar_seccion"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#oficio-container-grid");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="seccion-container";
        header("Location:../vista/administrador.php#oficio-container-grid");
     }
}

else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $validate=$ejecutar->UpdateTableSeccion(strtoupper($_POST["seccion_registrar"]), $_POST["update"]);
    if ($validate===2) {
        $_SESSION["error"]="El codigo ".$_POST["seccion_registrar"]." de seccion ya existe";
        $_SESSION["container"]="seccion-container";
        $_SESSION["update"]=$ejecutar->FindQuery("seccion","codigo", $_POST["update"]);
        header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $ejecutar->UpdateTableHorarioInSeccion(strtoupper($_POST["seccion_registrar"]), $_POST["update"]);
        $_SESSION["container"]="seccion-container";
        $_SESSION["update"]=$ejecutar->FindQuery("seccion","codigo", $_POST["seccion_registrar"]);
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("seccion","codigo",$_POST["delete"]);
    $ejecutar->DeleteTable("horario_docente","seccion",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}
else {
    $validate=$ejecutar->registrarSeccion(strtoupper($_POST["seccion_registrar"]));
    if ($validate===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El codigo ".$_POST["seccion_registrar"]." de seccion ya existe";
        
    }
    else {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="La seccion se registro correctamente";
        $_SESSION["link"]="../control/c_seccion.php?buscar_seccion=".strtoupper($_POST["seccion_registrar"]);
    }
    
}

?>