<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_pensum"]) && $_POST["buscar_pensum"]!="") {
    $dato=$ejecutar->GetAllPensum($_POST["buscar_pensum"]);
    if (count($dato)==0) {
       $_SESSION["error"]="El nombre que ingreso no existe";
       header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$dato;
        $_SESSION["container"]="pensum-container";
        header("Location:../vista/administrador.php#$url");
     }
}
else if (isset($_GET["buscar_pensum"]) && $_GET["buscar_pensum"]!="") {
    $dato=$ejecutar->GetAllPensum($_GET["buscar_pensum"]);
    if (count($dato)==0) {
       $_SESSION["error"]="El nombre que ingreso no existe";
       header("Location:../vista/administrador.php#pensum-container-grid");
    }
    else {
        $_SESSION["update"]=$dato;
        $_SESSION["container"]="pensum-container";
        header("Location:../vista/administrador.php#pensum-container-grid");
     }
}
else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $dato=$ejecutar->FindQuery("carrera","nombre",$_POST["carreras"]);
    $validate=$ejecutar->GetAllPensum($_POST["carreras"]);
    if ($validate===2) {
        $validate=0;
    }
    if ($dato===2) {
        $_SESSION["error"]="El nombre de carrera que ingreso no existe";
        $_SESSION["container"]="pensum-container";
        $_SESSION["update"]=$ejecutar->GetAllPensum($_POST["update"]);
        header("Location:../vista/administrador.php#$url");

    }
    else if (count($validate)>0 && $_POST["update"]!=$_POST["carreras"]) {
        $_SESSION["error"]="El nombre de carrera que ingreso ya existe";
        $_SESSION["container"]="pensum-container";
        $_SESSION["update"]=$ejecutar->GetAllPensum($_POST["update"]);
        header("Location:../vista/administrador.php#$url");
        
    }
    else {
        
        $delete=$ejecutar->FindQuery("carrera","nombre",$_POST["update"]);
        $ejecutar->DeleteTable("pensum","pnf",$delete[0]);
        $array=explode(",",$_POST["add"]);
        for ($i=0; $i < count($array); $i++) { 
            $validate=$ejecutar->registrarPensum($_POST["carreras"],$array[$i]);
        }
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="pensum-container";
        $_SESSION["update"]=$ejecutar->GetAllPensum($_POST["carreras"]);
        header("Location:../vista/administrador.php#$url");
        
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("pensum","pnf",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}

else {
    $dato=$ejecutar->FindQuery("carrera","nombre",$_POST["carreras"]);
    $validate=$ejecutar->FindQuery("pensum","pnf",$dato[0]);
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
            $ejecutar->registrarPensum($_POST["carreras"],$array[$i],"");
        }
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="La carrera se agrego correctamente";
        $_SESSION["link"]="../control/c_pensum.php?buscar_pensum=".$dato[1];
    }
}
?>