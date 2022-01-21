<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
if (isset($_POST["buscar_profesor"]) && $_POST["buscar_profesor"]!="") {
       $validate=$ejecutar->FindQuery('profesor','cedula',$_POST["buscar_profesor"]);
       if ($validate===2) {
           $_SESSION["error"]="La cedula que ingreso no existe";
           header("Location:../vista/administrador.php#profesor-find-flex");
       }
       else {
            $_SESSION["update"]=$validate;
            $_SESSION["container"]="profesor-container";
            header("Location:../vista/administrador.php#profesor-find-flex");
       }
   
}
else if (isset($_POST["update-profesor"]) && $_POST["update-profesor"]!="") {
    $ejecutar->setDatos($_POST["cedula"],$_POST["rol"],$_POST["primer_nombre"],$_POST["segundo_nombre"],$_POST["primer_apellido"],$_POST["segundo_apellido"],$_POST["direccion"], $_POST["telefono"]);
     $validate=$ejecutar->UpdateTableProfesor($_POST["update-profesor"]);
     if ($validate===2) {
        $_SESSION["error"]="La cedula que ingreso ya existe o es invalida";
        $_SESSION["container"]="profesor-container";
        $_SESSION["update"]=$ejecutar->FindQuery('profesor','cedula',$_POST["update-profesor"]);
        header("Location:../vista/administrador.php#profesor-find-flex");
     }
     else {
        $_SESSION["completado"]="Los datos del profesor han sido actualizados";
        $_SESSION["container"]="profesor-container";
        $_SESSION["update"]=$ejecutar->FindQuery('profesor','cedula',$_POST["cedula"]);
        if ($_POST["rol"]==="1") {
            $admin=$ejecutar->FindQuery("administrador","cedula",$_POST["update-profesor"]);
           if ($admin===2) {
                $ejecutar->registrarAdministrador("");
           }
           if ($_POST["update-profesor"]!=$_POST["cedula"]) {
                $ejecutar->UpdateTableAdmin($_POST["cedula"],$_POST["update-profesor"]);
           }
        }
        header("Location:../vista/administrador.php#profesor-find-flex");
     }
}
else if (isset($_POST["delete-profesor"]) && $_POST["delete-profesor"]!="") {
   $ejecutar->DeleteTable("profesor","cedula",$_POST["delete-profesor"]);
   $_SESSION["completado"]="Los datos fueron eliminados sastifactoriamente";
   header("Location:../vista/administrador.php#profesor-find-flex");
}
else {
    $ejecutar->setDatos($_POST["cedula"],$_POST["rol"],$_POST["primer_nombre"],$_POST["segundo_nombre"],$_POST["primer_apellido"],$_POST["segundo_apellido"],$_POST["direccion"], $_POST["telefono"]);
    $validate=$ejecutar->registrarProfesor();
    if ($validate===2) {

        header("Location:../vista/administrador.php#profesor-container-grid");
        $_SESSION["error"]="La cedula que ingreso ya existe o es invalida";
        
    
    }
    else {
        if ($_POST["rol"]==1) {
            $ejecutar->registrarAdministrador("");
           header("Location:../vista/administrador.php#profesor-container-grid");
           $_SESSION["completado"]="El Administrador fue registrado sastifactoriamente";
        }
        else {
            header("Location:../vista/administrador.php#profesor-container-grid");
            $_SESSION["completado"]="El profesor fue registrado sastifactoriamente";
        }
       
        
    }
}
?>