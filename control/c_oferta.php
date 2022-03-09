<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_oferta"]) && $_POST["buscar_oferta"]!="") {
    $dato=$ejecutar->GetAllPensum($_POST["buscar_oferta"]);
    if (count($dato)==0) {
       $_SESSION["error"]="El nombre que ingreso no existe";
       header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$dato;
        $_SESSION["container"]="oferta-container";
        header("Location:../vista/administrador.php#$url");
     }
}
else if (isset($_GET["buscar_oferta"]) && $_GET["buscar_oferta"]!="") {
    $dato=$ejecutar->GetAllPensum($_GET["buscar_oferta"]);
    if ($validate===2) {
       $_SESSION["error"]="El nombre que ingreso no existe";
       header("Location:../vista/administrador.php#oferta-container-grid");
    }
    else {
        $_SESSION["update"]=$dato;
        $_SESSION["container"]="oferta-container";
        header("Location:../vista/administrador.php#oferta-container-grid");
     }
}
else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $dato=$ejecutar->FindQuery("lapso_academico","trayecto",$_POST["lapso"]);
    $validate=$ejecutar->GetAllOferta($_POST["lapso"]);
    if ($dato===2) {
        $_SESSION["error"]="El nombre de lapso que ingreso no existe";
        $_SESSION["container"]="oferta-container";
        $_SESSION["update"]=$ejecutar->GetAllOferta($_POST["update"]);
        header("Location:../vista/administrador.php#$url");

    }
    else if (count($validate)>0 && $_POST["update"]!=$_POST["lapso"]) {
        
        $_SESSION["error"]="El nombre de lapso que ingreso ya existe";
        $_SESSION["container"]="oferta-container";
        $_SESSION["update"]=$ejecutar->GetAllOferta($_POST["update"]);
        header("Location:../vista/administrador.php#$url");
    }
    else {
        
        $delete=$ejecutar->FindQuery("lapso_academico","trayecto",$_POST["update"]);
        $ejecutar->DeleteTable("oferta","lapso_academico",$delete[0]);
        $array=explode(",",$_POST["add"]);
        for ($i=0; $i < count($array); $i++) { 
            $validate=$ejecutar->registrarOferta($_POST["lapso"],$array[$i]);
        }
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="oferta-container";
        $_SESSION["update"]=$ejecutar->GetAllOferta($_POST["lapso"]);
        header("Location:../vista/administrador.php#$url");
        
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("pensum","pnf",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}

else {
    $dato=$ejecutar->FindQuery("lapso_academico","trayecto",$_POST["lapso"]);
    $validate=$ejecutar->FindQuery("oferta","pnf",$dato[0]);
    if ($dato===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="La carrera que ingreso no existe";
    }
    else if (count($validate)>3) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="La carrera que ingreso ya existe";
    }
    else {
        $array=explode(",",$_POST["add"]);
        for ($i=0; $i < count($array); $i++) { 
            $ejecutar->registrarOferta($_POST["lapso"],$array[$i]);
        }
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="La carrera se agrego correctamente";
        $_SESSION["link"]="../control/c_pensum.php?buscar_pensum=".$dato[0];
    }
}
?>