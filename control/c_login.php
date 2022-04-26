<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$validate=$ejecutar->ValidateLogin($_POST["usuario"],$_POST["pass"]);
$administrador=$ejecutar->ValidateAdministrador($_POST["usuario"],$_POST["pass"]);
    if ($_POST["usuario"]=="unearte" && $_POST["pass"]=="unearte2022") {
        $_SESSION["usuario"]="master";
        $_SESSION["usuario_nombre"]=["UNEARTE","2022"];
        header("Location: ../vista/administrador.php");
    }
    else if ($validate===true) {
        $_SESSION["usuario"]="profesor";
        $_SESSION["cedula_origin"]=$_POST["usuario"];
        $disponibilidad=$ejecutar->FindQuery("bloque_disponibilidad","cedula",$_POST["usuario"]);
        $profesor=$ejecutar->GetAllProfesor($_POST["usuario"], 'cedula');
        $_SESSION["dedicacion"]=$profesor[0][7];
        echo $_SESSION["dedicacion"];
        if ($disponibilidad==2) {
            $_SESSION["cedula_usuario"]=$_POST["usuario"];
           
        }
        else {
            $_SESSION["cedula_usuario"]=$_POST["usuario"]." **";
        }
        $_SESSION["usuario_nombre"]=$ejecutar->GetName($_POST["usuario"]);
        header("Location: ../vista/profesor.php");
    }

    else if ($administrador===true) {
        $_SESSION["usuario"]="administrador";
        $_SESSION["usuario_nombre"]=$ejecutar->GetName($_POST["usuario"]);
        header("Location: ../vista/coordinador.php");
    }
    else if ($validate===2) {
        $_SESSION["usuario_cedula"]=$_POST["usuario"];
        $_SESSION["usuario_temp"]="profesor";
        header("Location: ../vista/configadmin.php");
    }
    else if ($validate===3) {
        $_SESSION["error"]="La contraseña es incorrecta";
        header("Location: ../vista/login.php");
    }
    else if ($administrador===2) {
        $_SESSION["usuario_cedula"]=$_POST["usuario"];
        $_SESSION["usuario_temp"]="admnistrador";
        header("Location: ../vista/configadmin.php");
    }
    else if ($administrador===3) {
        $_SESSION["error"]="La contraseña es incorrecta";
        header("Location: ../vista/login.php");
    }
    else if ($validate===false) {
        $_SESSION["error"]="El usuario no existe";
        //header("Location: ../vista/login.php");
    }
    else if ($administrador===false) {
        $_SESSION["error"]="El usuario no existe";
        header("Location: ../vista/login.php");
    }
?>