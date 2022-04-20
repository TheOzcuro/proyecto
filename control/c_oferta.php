<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_oferta"]) && $_POST["buscar_oferta"]!="") {
    $nombre=strtoupper($_POST["buscar_oferta"]);
    $dato=$ejecutar->GetAllOferta($nombre,"PNF");
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
    $nombre=strtoupper($_GET["buscar_oferta"]);
    $dato=$ejecutar->GetAllOferta($nombre,"PNF");
    if (count($dato)==0) {
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
    $dato=$ejecutar->UpdateTableOferta($_POST["lapso"], $_POST["carrera_oferta"], $_POST["horas_semana"], $_POST["unidad_credito"], $_POST["update"]);
    if ($dato===3) {
        $_SESSION["error"]="El nombre de carrera que ingreso no existe";
        $_SESSION["container"]="oferta-container";
        $_SESSION["update"]=$ejecutar->GetAllOferta($_POST["update"],'PNF');
        header("Location:../vista/administrador.php#$url");
    }
    else if($dato===2) {
        $_SESSION["error"]="El nombre de carrera que ingreso ya se encuentra registrada";
        $_SESSION["container"]="oferta-container";
        $_SESSION["update"]=$ejecutar->GetAllOferta($_POST["update"],'PNF');
        header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$ejecutar->GetAllOferta($_POST["carrera_oferta"],'PNF');
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="oferta-container";
        header("Location:../vista/administrador.php#$url");
        
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $carrera=$ejecutar->FindQuery('carrera', 'nombre', $_POST["delete"]);
    $ejecutar->DeleteTable("oferta","pnf",$carrera[0]);
    $ejecutar->DeleteTable("horario_docente","carrera",$carrera[0]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}

else {
    $dato=$ejecutar->FindQuery("lapso_academico","trayecto",$_POST["lapso"]);
    if ($dato===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El trayecto que ingreso no existe";
    }
    else {
        $val=$ejecutar->registrarOferta($_POST["lapso"],$_POST["carrera_oferta"],$_POST["horas_semana"],$_POST["unidad_credito"]);
        if ($val===2) {
            header("Location:../vista/administrador.php#$url");
            $_SESSION["error"]="La carrera que ingreso ya existe";
        }
        if ($val===3) {
            header("Location:../vista/administrador.php#$url");
            $_SESSION["error"]="La carrera que ingreso no existe";
        }
        else {
            header("Location:../vista/administrador.php#$url");
            $_SESSION["completado"]="La carrera se agrego correctamente";
            $_SESSION["link"]="../control/c_oferta.php?buscar_oferta=".$_POST["carrera_oferta"];
        }
       
    }
}
?>