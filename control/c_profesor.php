<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_profesor"]) && $_POST["buscar_profesor"]!="") {
       $validate=$ejecutar->FindQuery('profesor','cedula',$_POST["buscar_profesor"]);
       if ($validate===2) {
           $_SESSION["error"]="La cedula que ingreso no existe";
           header("Location:../vista/administrador.php#$url");
       }
       else {
            $_SESSION["update"]=$validate;
            $_SESSION["container"]="profesor-container";
            header("Location:../vista/administrador.php#$url");
       }
   
}
else if (isset($_POST["find-correo"]) && $_POST["find-correo"]!="") {
    $validate=$ejecutar->FindQuery('profesor','correo',$_POST["correo"]);
    if($validate!==2){
        echo "yes";
    }
    else echo "no";

}
else if (isset($_GET["buscar_profesor"]) && $_GET["buscar_profesor"]!="") {
    $validate=$ejecutar->FindQuery('profesor','cedula',$_GET["buscar_profesor"]);
    if ($validate===2) {
        $_SESSION["error"]="La cedula que ingreso no existe";
        header("Location:../vista/administrador.php#profesor-container-grid");
    }
    else {
         $_SESSION["update"]=$validate;
         $_SESSION["container"]="profesor-container";
         header("Location:../vista/administrador.php#profesor-container-grid");
    }

}
else if (isset($_POST["find-user"]) && $_POST["find-user"]!=""){
    $validate=$ejecutar->FindQuery('profesor','cedula',$_POST["cedula"]);
    if($validate!==2){
        $_SESSION["link_error"]="../control/c_profesor.php?buscar_profesor=".$_POST["cedula"];
        $nombre=$validate[1]." ".$validate[3];
        echo $nombre;
        
    }
    else echo "no";
}
else if (isset($_POST["update-profesor"]) && $_POST["update-profesor"]!="") {
    $dato=$ejecutar->FindQuery('profesor','correo',$_POST["correo"]);
    $dato_origin=$ejecutar->FindQuery("profesor","cedula",$_POST["update-profesor"]);
    if ($dato[11]==$dato_origin[11] || $dato===2) {

        $ejecutar->setDatos(
            $_POST["cedula"],$_POST["rol"],$_POST["primer_nombre"],$_POST["segundo_nombre"],$_POST["primer_apellido"],$_POST["segundo_apellido"],$_POST["direccion"], $_POST["telefono"], $_POST["tipo_contratacion"], $_POST["categoria"], $_POST["dedicacion"], $_POST["telefono_fijo"],$_POST["correo"], $_POST["titulo"], $_POST["oficio"]);
         $validate=$ejecutar->UpdateTableProfesor($_POST["update-profesor"]);
    }
    if ($dato[11]!=$dato_origin[11] && $dato!==2) {
       $validate=3;
    }
    if ($validate===2) {
         
        $_SESSION["error"]="La cedula que ingreso ya existe o es invalida";
        $_SESSION["container"]="profesor-container";
        $_SESSION["update"]=$ejecutar->FindQuery('profesor','cedula',$_POST["update-profesor"]);
        header("Location:../vista/administrador.php#$url");
        
    }
    else if ($validate===3) {
        $_SESSION["error"]="El correo que ingreso ya existe";
        $_SESSION["container"]="profesor-container";
        $_SESSION["update"]=$ejecutar->FindQuery('profesor','cedula',$_POST["update-profesor"]);
        header("Location:../vista/administrador.php#$url");
     }
     else {
        $_SESSION["completado"]="Los datos del profesor han sido actualizados";
        $_SESSION["container"]="profesor-container";
        $ejecutar->UpdateTableDisponibilidad($_POST["cedula"], $_POST["update-profesor"]);
        $_SESSION["update"]=$ejecutar->FindQuery('profesor','cedula',$_POST["cedula"]);
        $ejecutar->UpdateCampoHorario('cedula_docente',$_POST["cedula"],$_POST["update-profesor"]);
        $ejecutar->registrarOficio($_POST["oficio"]);
        if ($_POST["rol"]==="1") {
            $admin=$ejecutar->FindQuery("administrador","cedula",$_POST["update-profesor"]);
           if ($admin===2) {
                $ejecutar->registrarAdministrador("");
                $ejecutar->DeleteTable("profesor_pass","cedula",$_POST["update-profesor"]);
           }
           if ($_POST["update-profesor"]!=$_POST["cedula"]) {
                $ejecutar->UpdateTableAdmin($_POST["cedula"],$_POST["update-profesor"]);
           }
        }
        if ($_POST["rol"]==="0") {
            $admin=$ejecutar->FindQuery("profesor_pass","cedula",$_POST["update-profesor"]);
           if ($admin===2) {
                $ejecutar->registrarProfesorLogin();
                $ejecutar->DeleteTable("administrador","cedula",$_POST["update-profesor"]);
           }
           else {
                $ejecutar->UpdateTableProfesorPass($_POST["cedula"],$_POST["update-profesor"]);
           }
        }
        header("Location:../vista/administrador.php#$url");
     }
}
else if (isset($_POST["delete-profesor"]) && $_POST["delete-profesor"]!="") {
   $ejecutar->DeleteTable("profesor","cedula",$_POST["delete-profesor"]);
   $ejecutar->DeleteTable("profesor_pass","cedula",$_POST["delete-profesor"]);
   $ejecutar->DeleteTable("administrador","cedula",$_POST["delete-profesor"]);
   $ejecutar->DeleteTable("bloque_disponibilidad","cedula",$_POST["delete-profesor"]);
   $ejecutar->DeleteTable("horario_docente","cedula_docente",$_POST["delete-profesor"]);
   $_SESSION["completado"]="Los datos fueron eliminados sastifactoriamente";
   header("Location:../vista/administrador.php#$url");
}
else {
    $ejecutar->setDatos(
        $_POST["cedula"],$_POST["rol"],$_POST["primer_nombre"],$_POST["segundo_nombre"],$_POST["primer_apellido"],$_POST["segundo_apellido"],$_POST["direccion"], $_POST["telefono"], $_POST["tipo_contratacion"], $_POST["categoria"], $_POST["dedicacion"], $_POST["telefono_fijo"],$_POST["correo"], $_POST["titulo"], $_POST["oficio"]);
    $validate=$ejecutar->registrarProfesor();
    if ($validate===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="La cedula que ingreso ya existe o es invalida";
    }
    else {
        if ($_POST["rol"]==1) {
            $ejecutar->registrarAdministrador("");
            $val=$ejecutar->FindQuery("profesor_pass","cedula",$_POST["cedula"]);
            if ($val===2) {
                header("Location:../vista/administrador.php#$url");
                $_SESSION["completado"]="El profesor fue registrado sastifactoriamente";
                $_SESSION["link"]="../control/c_profesor.php?buscar_profesor=".$_POST["cedula"];
            }
            else {
                $ejecutar->DeleteTable("profesor_pass","cedula",$_POST["cedula"]);
                header("Location:../vista/administrador.php#$url");
                $_SESSION["completado"]="El profesor fue registrado sastifactoriamente";
                $_SESSION["link"]="../control/c_profesor.php?buscar_profesor=".$_POST["cedula"];
            }
           header("Location:../vista/administrador.php#$url");
           $_SESSION["completado"]="El Administrador fue registrado sastifactoriamente";
        }
        if ($_POST["rol"]==0) {
            $ejecutar->registrarProfesorLogin();
            $val=$ejecutar->FindQuery("administrador","cedula",$_POST["cedula"]);
            if ($val===2) {
                header("Location:../vista/administrador.php#$url");
                $_SESSION["completado"]="El profesor fue registrado sastifactoriamente";
                $_SESSION["link"]="../control/c_profesor.php?buscar_profesor=".$_POST["cedula"];
            }
            else {
                $ejecutar->DeleteTable("administrador","cedula",$_POST["cedula"]);
                header("Location:../vista/administrador.php#$url");
                $_SESSION["completado"]="El profesor fue registrado sastifactoriamente";
                $_SESSION["link"]="../control/c_profesor.php?buscar_profesor=".$_POST["cedula"];
            }
        }
       
    }
}
?>