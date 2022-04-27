<?php 
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["cedula_horario"]) && $_POST["cedula_horario"]!="") {
    $_SESSION["lista_disponibilidad"]=$ejecutar->GetDisponibilidad($_POST["cedula_horario"]);
    
    if (count($_SESSION["lista_disponibilidad"])==0) {
        $_SESSION["error"]="La cedula que ingreso no existe";
        unset($_SESSION["lista_disponibilidad"]);
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
    $_SESSION["disponibilidad_profesor"]=$ejecutar->GetAllHorario($_POST["cedula_horario"], "cedula");
    
    $_SESSION["tipo_horario"]=$_POST["tipo_horario"];
    $_SESSION["lapso"]=$_POST["lapso_horario"];
    $_SESSION["carreras_horario"]=$ejecutar->GetCarrerasOferta($_POST["lapso_horario"]);
    if (count($_SESSION["carreras_horario"])==0) {
        $_SESSION["error"]="El lapso que ingreso no existe o no tiene carreras agregadas";
        unset($_SESSION["lista_disponibilidad"]);
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
    $bloques_add=$ejecutar->GetHorario($_POST["cedula_horario"],$_POST["lapso_horario"],$_SESSION["tipo_horario"]);
    
    if ($bloques_add!=2) {
        $_SESSION["find_horario"]=$bloques_add;
        print_r($_SESSION["find_horario"]);
    }
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
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable('horario_docente', 'cedula_docente',$_POST["delete"]);
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
else if (isset($_POST["carrera_horario"]) && $_POST["carrera_horario"]!="") {
   echo json_encode([$ejecutar->GetMateriasPensumWithPNF($_POST["carrera_horario"]),$ejecutar->GetAulasHorario($_POST["bloque"],$_POST['dia'],$_POST['lapso'])]);
}
else if (isset($_POST["input_horario"]) && $_POST["input_horario"]!="") {
     $ejecutar->DeleteTableTwoWhere('horario_docente','cedula_docente',$_POST["input_horario"][0],'tipo',$_SESSION["tipo_horario"]);
     for ($i=2; $i < count($_POST["input_horario"]); $i=$i+5) { 
        if ($_POST["input_horario"][$i]!="") {
            $ejecutar->registrarHorario($_POST["input_horario"][0],$_POST["input_horario"][$i+2],$_POST["input_horario"][1],$_POST["input_horario"][$i+3],$_POST["input_horario"][$i+1],$_POST["input_horario"][$i],$_POST["input_horario"][$i+4],$_SESSION["tipo_horario"]);
        }
     }
     $_SESSION["completado"]="El horario se creo correctamente";
    $_SESSION["lista_disponibilidad"]=$ejecutar->GetDisponibilidad($_POST["input_horario"][0]);
    $_SESSION["disponibilidad_profesor"]=$ejecutar->GetAllHorario($_POST["input_horario"][0], "cedula");
    $_SESSION["carreras_horario"]=$ejecutar->GetCarrerasOferta($_POST["input_horario"][1]);
    $_SESSION["find_horario"]=$ejecutar->GetHorario($_POST["input_horario"][0],$_POST["input_horario"][1],$_SESSION["tipo_horario"]);
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

?>