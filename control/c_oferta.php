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
        $_SESSION["update"]=$dato;
        $_SESSION["container"]="oferta-container";
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
else if (isset($_GET["buscar_oferta"]) && $_GET["buscar_oferta"]!="") {
    $nombre=strtoupper($_GET["buscar_oferta"]);
    $dato=$ejecutar->GetAllOferta($nombre,"PNF");
    if (count($dato)==0) {
       $_SESSION["error"]="El nombre que ingreso no existe";
       if ($_SESSION["usuario"]=="profesor") {
        header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#oferta-container-grid");
        }
        else {
            header("Location:../vista/administrador.php#oferta-container-grid");
        }
       
    }
    else {
        $_SESSION["update"]=$dato;
        $_SESSION["container"]="oferta-container";
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
            }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#oferta-container-grid");
        }
        else {
            header("Location:../vista/administrador.php#oferta-container-grid");
        }
     }
}
else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $validate=$ejecutar->ValidateOferta($_POST["carrera_oferta"],$_POST["lapso"]);
    $dato=$ejecutar->FindQuery("lapso_academico","lapso",$_POST["lapso"]);
    $dato2=$ejecutar->FindQuery("carrera","nombre",$_POST["carrera_oferta"]);
    if ($validate!=false) {
        $_SESSION["error"]="La carrera ".$_POST["carrera_oferta"]." ya se encuentra registrada al lapso ".$_POST["lapso"]."";
        $_SESSION["update"]=$ejecutar->FindQueryOferta($_POST["carrera_oferta"],$_POST["lapso"]);
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
    else if ($dato===2) {
        $_SESSION["error"]="El lapso que ingreso no existe";
        $_SESSION["container"]="oferta-container";
        $_SESSION["update"]=$ejecutar->GetAllOferta($_POST["update"],'PNF');
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
    else if($dato2===2) {
        $_SESSION["error"]="El nombre de carrera que ingreso no existe";
        $_SESSION["container"]="oferta-container";
        $_SESSION["update"]=$ejecutar->GetAllOferta($_POST["update"],'PNF');
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
        $dato=$ejecutar->UpdateTableOferta($_POST["lapso"], $_POST["carrera_oferta"], $_POST["horas_semana"], $_POST["unidad_credito"], $_POST["update"], $_POST["update_lapso"]);
        echo $dato;
        $_SESSION["update"]=$ejecutar->FindQueryOferta($_POST["carrera_oferta"],$_POST["lapso"]);
        echo $_SESSION["update"];
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="oferta-container";
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
    $carrera=$ejecutar->FindQuery('carrera', 'nombre', $_POST["delete"]);
    $ejecutar->DeleteTableTwoWhere("oferta","pnf",$carrera[0], "lapso_academico",$_POST["delete_lapso"]);
    $ejecutar->DeleteTable("horario_docente","carrera",$carrera[0]);
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
    $validate=$ejecutar->ValidateOferta($_POST["carrera_oferta"],$_POST["lapso"]);
    $dato=$ejecutar->FindQuery("lapso_academico","lapso",$_POST["lapso"]);
    $dato2=$ejecutar->FindQuery("carrera","nombre",$_POST["carrera_oferta"]);
    if ($dato===2) {
        $_SESSION["error"]="El lapso que ingreso no existe";
        $_SESSION["container"]="oferta-container";
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
    else if($dato2===2) {
        $_SESSION["error"]="El nombre de carrera que ingreso no existe";
        $_SESSION["container"]="oferta-container";
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
    else if ($validate!=false) {
        $_SESSION["error"]="La carrera ".$_POST["carrera_oferta"]." ya se encuentra registrada al lapso ".$_POST["lapso"]."";
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
        $val=$ejecutar->registrarOferta($_POST["lapso"],$_POST["carrera_oferta"],$_POST["horas_semana"],$_POST["unidad_credito"]);
        if ($val===2) {
            if ($_SESSION["usuario"]=="profesor") {
                header("Location:../vista/profesor.php#$url");
            }
            else if($_SESSION["usuario"]=="administrador"){
                header("Location:../vista/coordinador.php#$url");
            }
            else {
                header("Location:../vista/administrador.php#$url");
            }
            $_SESSION["error"]="La carrera que ingreso ya existe";
        }
        if ($val===3) {
            if ($_SESSION["usuario"]=="profesor") {
                header("Location:../vista/profesor.php#$url");
            }
            else if($_SESSION["usuario"]=="administrador"){
                header("Location:../vista/coordinador.php#$url");
            }
            else {
                header("Location:../vista/administrador.php#$url");
            }
            $_SESSION["error"]="La carrera que ingreso no existe";
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
            $_SESSION["completado"]="La carrera se agrego correctamente";
            $_SESSION["link"]="../control/c_oferta.php?buscar_oferta=".$_POST["carrera_oferta"];
        }
       
    }
}
?>