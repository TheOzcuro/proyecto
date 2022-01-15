<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
if (isset($_POST["buscar_profesor"]) && $_POST["buscar_profesor"]!="") {
   if (isset($_POST["cedula"]) && $_POST["cedula"]!="") {
        $ejecutar->setDatos($_POST["cedula"],$_POST["rol"],$_POST["primer_nombre"],$_POST["segundo_nombre"],$_POST["primer_apellido"],$_POST["segundo_apellido"],$_POST["direccion"], $_POST["telefono"]);
   }
   else {
        $_SESSION["profesor"]=$ejecutar->FindQuery('profesor','cedula',$_POST["buscar_profesor"]);
        header("Location:../vista/administrador.php#profesor-container-grid");
   }
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