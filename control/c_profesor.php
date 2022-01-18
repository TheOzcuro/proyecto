<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
echo $_POST["update"];
if (isset($_POST["buscar_profesor"]) && $_POST["buscar_profesor"]!="") {
       $validate=$ejecutar->FindQuery('profesor','cedula',$_POST["buscar_profesor"]);
       if ($validate===2) {
           $_SESSION["error"]="profesor_find";
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
     $validate=$ejecutar->UpdateTable($_POST["update-profesor"],"profesor");
     if ($validate===2) {
        $_SESSION["error"]="profesor_update";
        header("Location:../vista/administrador.php#profesor-find-flex");
     }
     else {
        $_SESSION["completado"]="profesor_update";
        $_SESSION["container"]="profesor-container";
        $_SESSION["update"]=$ejecutar->FindQuery('profesor','cedula',$_POST["cedula"]);
        header("Location:../vista/administrador.php#profesor-find-flex");
     }
}
else if (isset($_POST["delete-profesor"]) && $_POST["delete-profesor"]!="") {
   $ejecutar->DeleteTable("profesor","cedula",$_POST["delete-profesor"]);
   $_SESSION["completado"]="delete";
   header("Location:../vista/administrador.php#profesor-find-flex");
}
else {
    $ejecutar->setDatos($_POST["cedula"],$_POST["rol"],$_POST["primer_nombre"],$_POST["segundo_nombre"],$_POST["primer_apellido"],$_POST["segundo_apellido"],$_POST["direccion"], $_POST["telefono"]);
    $validate=$ejecutar->registrarProfesor();
    if ($validate===2) {
        header("Location:../vista/administrador.php#profesor-container-grid");
        $_SESSION["error"]="profesor_cedula";
        
    
    }
    else {
        if ($_POST["rol"]==1) {
            $ejecutar->registrarAdministrador("");
           header("Location:../vista/administrador.php#profesor-container-grid");
           $_SESSION["completado"]="profesor_registro";
        }
        else {
            header("Location:../vista/administrador.php#profesor-container-grid");
            $_SESSION["completado"]="profesor_registro";
        }
       
        
    }
}
?>