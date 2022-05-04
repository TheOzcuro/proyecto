<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_lapso"]) && $_POST["buscar_lapso"]!="") {
    echo $validate=$ejecutar->FindQuery("lapso_academico","periodo", $_POST["buscar_lapso"]);
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
        $_SESSION["container"]="lapso_academico-container";
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
else if (isset($_GET["buscar_lapso"]) && $_GET["buscar_lapso"]!="") {
    $validate=$ejecutar->FindQuery("lapso_academico","periodo", $_GET["buscar_lapso"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       if ($_SESSION["usuario"]=="profesor") {
        header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#lapso_academico-container-grid");
        }
        else {
            header("Location:../vista/administrador.php#lapso_academico-container-grid");
        }
      
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="lapso_academico-container";
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
            }
            else if($_SESSION["usuario"]=="administrador"){
                header("Location:../vista/coordinador.php#lapso_academico-container-grid");
            }
            else {
                header("Location:../vista/administrador.php#lapso_academico-container-grid");
            }
     }
}
else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $dato=$ejecutar->FindQuery("lapso_academico","periodo", $_POST["trayecto"]);
    $dato_origin=$ejecutar->FindQuery("lapso_academico","periodo", $_POST["update"]);
    $dato_inicio=explode("-",$_POST["fecha_inicio"]);
    $dato_final=explode("-",$_POST["fecha_final"]);
    $fecha_inicio=$dato_inicio[2]."-".$dato_inicio[1]."-".$dato_inicio[0];
    $fecha_final=$dato_final[2]."-".$dato_final[1]."-".$dato_final[0];
    $array=$ejecutar->GetAll("lapso_academico");
    $type=false;
    for ($i=0; $i < count($array); $i++) { 
        if ($array[$i][3]==1) {
            $type=true;
        }
    }
    echo $type;
    if ($type===false || $_POST["lapso_activo"]==0 && $dato[0]==$dato_origin[0] || $dato===2) {
            $validate=$ejecutar->UpdateTableLapso($_POST["trayecto"], $fecha_inicio, $fecha_final,$_POST["lapso_activo"], $_POST["update"]);
    }
    if ($dato[0]!=$dato_origin[0] && $dato!==2) {
       $validate=3;
    }
   
    if ($validate===3) {
        $_SESSION["error"]="El nombre de lapso que ingreso ya existe";
        $_SESSION["container"]="lapso_academico-container";
        $_SESSION["update"]=$ejecutar->FindQuery("lapso_academico","periodo", $_POST["update"]);
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
    else if ($validate===2) {
        $_SESSION["error"]="El nombre de lapso que ingreso ya existe";
        $_SESSION["container"]="lapso_academico-container";
        $_SESSION["update"]=$ejecutar->FindQuery("lapso_academico","periodo", $_POST["update"]);
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
    else if ($type && $_POST["lapso_activo"]==1) {
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
        $_SESSION["error"]="Ya existe un periodo academico activo, si quiere registrar uno nuevo, borre o desactive el actual periodo academico";
    }
    else {
        $ejecutar->UpdateCampoHorario('lapso_academico',$_POST["trayecto"],$_POST["update"]);
        if ($_POST["trayecto"]!=$_POST["update"]) {
            $ejecutar->UpdateTableLapsoOferta($_POST["update"],$_POST["trayecto"]);
        }
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="lapso_academico-container";
        $_SESSION["update"]=$ejecutar->FindQuery("lapso_academico","periodo", $_POST["trayecto"]);
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
    $ejecutar->DeleteTable("oferta","lapso_academico",$_POST["delete"]);
    $ejecutar->DeleteTable("lapso_academico","periodo",$_POST["delete"]);
    $ejecutar->DeleteTable("horario_docente","lapso_academico",$_POST["delete"]);
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
    $dato=$ejecutar->GetAll("lapso_academico");
    for ($i=0; $i < count($dato); $i++) { 
        if ($dato[$i][3]==1) {
            $type=true;
        }
        else {
            $type=false;
        }
    }
    print_r($_POST["fecha_final"]);
    if (count($dato)>0 && $_POST["lapso_activo"]==1 && $type) {
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
        $_SESSION["error"]="Ya existe un periodo academico activo, si quiere registrar uno nuevo, borre o desactive el actual periodo academico";
    }
    else {
        $dato_inicio=explode("-",$_POST["fecha_inicio"]);
        $dato_final=explode("-",$_POST["fecha_final"]);
        $fecha_inicio=$dato_inicio[2]."-".$dato_inicio[1]."-".$dato_inicio[0];
        $fecha_final=$dato_final[2]."-".$dato_final[1]."-".$dato_final[0];
        $validate=$ejecutar->registrarLapso($_POST["trayecto"],$fecha_inicio,$fecha_final,$_POST["lapso_activo"]);
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
            $_SESSION["error"]="El trayecto de lapso que ingreso ya existe";
        }
        else if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
        $_SESSION["completado"]="El periodo se creo correctamente";
        $_SESSION["update"]=$ejecutar->FindQuery("lapso_academico","periodo", $_POST["trayecto"]);
        $_SESSION["link"]="../control/c_lapso_academico.php?buscar_lapso=".$_POST["trayecto"];
    }
}

?>