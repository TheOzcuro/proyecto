<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_lapso"]) && $_POST["buscar_lapso"]!="") {
    $validate=$ejecutar->FindQuery("lapso_academico","trayecto", $_POST["buscar_lapso"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="lapso_academico-container";
        header("Location:../vista/administrador.php#$url");
     }
}
else if (isset($_GET["buscar_lapso"]) && $_GET["buscar_lapso"]!="") {
    $validate=$ejecutar->FindQuery("lapso_academico","trayecto", $_POST["buscar_lapso"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#lapso-container-grid");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="lapso_academico-container";
        header("Location:../vista/administrador.php#lapso-container-grid");
     }
}
else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $dato=$ejecutar->FindQuery("lapso_academico","trayecto", $_POST["trayecto"]);
    if ($dato[1]==$_POST["nombre_carrera"] || $dato===2) {
        $validate=$ejecutar->UpdateTableLapso($_POST["trayecto"], $_POST["fecha_inicio"], $_POST["fecha_final"], $_POST["update"]);
    }
    if ($dato[1]!=$_POST["nombre_carrera"] && $dato!==2) {
       $validate=3;
    }
   
    if ($validate===3) {
        $_SESSION["error"]="El nombre de lapso que ingreso ya existe";
        $_SESSION["container"]="lapso_academico-container";
        $_SESSION["update"]=$ejecutar->FindQuery("lapso_academico","trayecto", $_POST["trayecto"]);
        header("Location:../vista/administrador.php#$url");

    }
    else if ($validate===2) {
        $_SESSION["error"]="El nombre de lapso que ingreso ya existe";
        $_SESSION["container"]="lapso_academico-container";
        $_SESSION["update"]=$ejecutar->FindQuery("lapso_academico","trayecto", $_POST["trayecto"]);
        header("Location:../vista/administrador.php#$url");
    }
    else {
        if ($_POST["trayecto"]!=$_POST["update"]) {
            $ejecutar->UpdateTableLapsoOferta($_POST["update"],$_POST["trayecto"]);
        }
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="lapso_academico-container";
        $_SESSION["update"]=$ejecutar->FindQuery("lapso_academico","trayecto", $_POST["trayecto"]);
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("oferta","lapso_academico",$_POST["delete"]);
    $ejecutar->DeleteTable("lapso_academico","trayecto",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}

else {
    $dato=$ejecutar->FindQuery("lapso_academico","trayecto", $_POST["trayecto"]);
    $validate=$ejecutar->registrarLapso($_POST["trayecto"],$_POST["fecha_inicio"],$_POST["fecha_final"]);
    if ($validate===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El trayecto de lapso que ingreso ya existe";
    }
    else if ($dato!==2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El trayecto de lapso que ingreso ya existe";
    }
    else {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="El lapso se creo correctamente";
        $_SESSION["update"]=$ejecutar->FindQuery("lapso_academico","trayecto", $_POST["trayecto"]);
        $_SESSION["link"]="../control/c_lapso_academico.php?buscar_lapso=".$_POST["trayecto"];
    }
}

?>